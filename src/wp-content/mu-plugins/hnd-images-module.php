<?php
/**
 * Plugin Name: HND Images Module
 * Description: Moduł optymalizacji obrazów - WebP support, wymiary, LCP optimization, lazy loading.
 * Version: 2.0.0
 * Author: PB MEDIA
 *
 * @package HND_Images_Module
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Klasa modułu optymalizacji obrazów.
 */
class HND_Images_Module {

	/**
	 * Instancja singletona.
	 *
	 * @var HND_Images_Module
	 */
	private static $instance = null;

	/**
	 * Referencja do głównego optymalizatora.
	 *
	 * @var HND_PageSpeed_Optimizer
	 */
	private $optimizer = null;

	/**
	 * Licznik obrazów (do wykrywania LCP).
	 *
	 * @var int
	 */
	private $image_count = 0;

	/**
	 * Pobierz instancję.
	 *
	 * @return HND_Images_Module
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Lokalne ustawienia (cache).
	 *
	 * @var array
	 */
	private $settings = array();

	/**
	 * Konstruktor.
	 */
	private function __construct() {
		// Użyj późniejszego hooka, aby główny optymalizator był już załadowany.
		add_action( 'plugins_loaded', array( $this, 'init' ), 25 );
	}

	/**
	 * Inicjalizacja.
	 */
	public function init() {
		if ( class_exists( 'HND_PageSpeed_Optimizer' ) ) {
			$this->optimizer = HND_PageSpeed_Optimizer::get_instance();
		}

		// Załaduj ustawienia z bazy danych (niezależnie od optymalizatora).
		$this->load_settings();

		$this->init_hooks();
	}

	/**
	 * Załaduj ustawienia bezpośrednio z bazy danych.
	 * To zapewnia, że ustawienia są zawsze aktualne.
	 */
	private function load_settings() {
		$option_name = 'hnd_pagespeed_optimizer_settings';
		$saved = get_option( $option_name, array() );

		// Domyślne ustawienia dla tego modułu.
		$defaults = array(
			'enable_webp_support'   => true,
			'add_image_dimensions'  => true,
			'optimize_lcp_image'    => true,
			'lazy_load_iframes'     => true,
			'image_quality'         => 82,
		);

		$this->settings = wp_parse_args( $saved, $defaults );
	}

	/**
	 * Sprawdź czy funkcja jest włączona.
	 *
	 * @param string $key Klucz ustawienia.
	 * @return bool
	 */
	private function is_enabled( $key ) {
		// Najpierw sprawdź lokalne ustawienia (pobrane z bazy).
		if ( isset( $this->settings[ $key ] ) ) {
			return (bool) $this->settings[ $key ];
		}

		// Fallback do głównego optymalizatora.
		if ( $this->optimizer && method_exists( $this->optimizer, 'is_enabled' ) ) {
			return $this->optimizer->is_enabled( $key );
		}

		// Domyślnie włączone jeśli brak ustawienia.
		return true;
	}

	/**
	 * Inicjalizuj hooki.
	 */
	private function init_hooks() {
		// 1. Dodaj wymiary do obrazów.
		if ( $this->is_enabled( 'add_image_dimensions' ) ) {
			add_filter( 'wp_get_attachment_image_attributes', array( $this, 'add_image_dimensions' ), 10, 3 );
			add_filter( 'the_content', array( $this, 'add_dimensions_to_content_images' ), 15 );
		}

		// 2. Optymalizuj LCP image.
		if ( $this->is_enabled( 'optimize_lcp_image' ) ) {
			add_filter( 'wp_get_attachment_image_attributes', array( $this, 'optimize_lcp_image' ), 15, 3 );
		}

		// 3. WebP Support.
		if ( $this->is_enabled( 'enable_webp_support' ) ) {
			add_filter( 'upload_mimes', array( $this, 'add_webp_mime' ) );
			add_filter( 'wp_get_attachment_image_attributes', array( $this, 'add_webp_srcset' ), 20, 3 );
		}

		// 4. Lazy load iframes.
		if ( $this->is_enabled( 'lazy_load_iframes' ) ) {
			add_filter( 'the_content', array( $this, 'lazy_load_iframes' ), 20 );
			add_filter( 'embed_oembed_html', array( $this, 'lazy_load_embeds' ), 10, 4 );
		}

		// 5. Dodaj decoding="async" do obrazów.
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'add_decoding_async' ), 10, 3 );

		// 6. Napraw brakujące alt.
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'ensure_alt_attribute' ), 10, 3 );
		add_filter( 'the_content', array( $this, 'fix_empty_alt_in_content' ), 25 );

		// 7. Optymalizuj featured images.
		add_filter( 'post_thumbnail_html', array( $this, 'optimize_featured_image' ), 10, 5 );

		// 8. Preload hero image.
		add_action( 'wp_head', array( $this, 'preload_hero_image' ), 2 );

		// 9. Obsługa AVIF.
		add_filter( 'upload_mimes', array( $this, 'add_avif_mime' ) );

		// 10. Usuń domyślne lazy loading z LCP.
		add_filter( 'wp_img_tag_add_loading_attr', array( $this, 'skip_lazy_for_lcp' ), 10, 3 );
	}

	/**
	 * Dodaj wymiary do obrazów.
	 *
	 * @param array        $attr       Atrybuty.
	 * @param WP_Post      $attachment Załącznik.
	 * @param string|array $size       Rozmiar.
	 * @return array
	 */
	public function add_image_dimensions( $attr, $attachment, $size ) {
		// Pobierz wymiary obrazu.
		$image_src = wp_get_attachment_image_src( $attachment->ID, $size );

		if ( $image_src ) {
			if ( ! isset( $attr['width'] ) || empty( $attr['width'] ) ) {
				$attr['width'] = $image_src[1];
			}
			if ( ! isset( $attr['height'] ) || empty( $attr['height'] ) ) {
				$attr['height'] = $image_src[2];
			}
		}

		return $attr;
	}

	/**
	 * Dodaj wymiary do obrazów w treści.
	 *
	 * @param string $content Treść.
	 * @return string
	 */
	public function add_dimensions_to_content_images( $content ) {
		if ( empty( $content ) ) {
			return $content;
		}

		// Znajdź obrazy bez wymiarów.
		return preg_replace_callback(
			'/<img([^>]*)>/i',
			array( $this, 'add_dimensions_to_image_tag' ),
			$content
		);
	}

	/**
	 * Callback dla dodawania wymiarów.
	 *
	 * @param array $matches Dopasowania.
	 * @return string
	 */
	private function add_dimensions_to_image_tag( $matches ) {
		$tag   = $matches[0];
		$attrs = $matches[1];

		// Sprawdź czy ma już wymiary.
		if ( preg_match( '/width\s*=/i', $attrs ) && preg_match( '/height\s*=/i', $attrs ) ) {
			return $tag;
		}

		// Pobierz src.
		if ( ! preg_match( '/src\s*=\s*["\']([^"\']+)["\']/i', $attrs, $src_match ) ) {
			return $tag;
		}

		$src = $src_match[1];

		// Konwertuj URL na ścieżkę.
		$upload_dir = wp_upload_dir();
		$file_path  = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $src );

		// Jeśli to ścieżka względna.
		if ( strpos( $file_path, ABSPATH ) === false && strpos( $file_path, '/' ) === 0 ) {
			$file_path = ABSPATH . ltrim( $file_path, '/' );
		}

		// Pobierz wymiary.
		if ( file_exists( $file_path ) ) {
			$size = @getimagesize( $file_path );
			if ( $size ) {
				$width  = $size[0];
				$height = $size[1];

				// Dodaj brakujące wymiary.
				if ( ! preg_match( '/width\s*=/i', $attrs ) ) {
					$attrs .= ' width="' . esc_attr( $width ) . '"';
				}
				if ( ! preg_match( '/height\s*=/i', $attrs ) ) {
					$attrs .= ' height="' . esc_attr( $height ) . '"';
				}

				return '<img' . $attrs . '>';
			}
		}

		return $tag;
	}

	/**
	 * Optymalizuj LCP image.
	 *
	 * @param array        $attr       Atrybuty.
	 * @param WP_Post      $attachment Załącznik.
	 * @param string|array $size       Rozmiar.
	 * @return array
	 */
	public function optimize_lcp_image( $attr, $attachment, $size ) {
		$this->image_count++;

		// Duże rozmiary potencjalnie LCP.
		$lcp_sizes = array( 'full', 'large', '2048x2048', '1536x1536', 'hero', 'banner' );

		// Pierwszy duży obraz na stronie głównej to prawdopodobnie LCP.
		if ( is_front_page() && $this->image_count <= 2 ) {
			if ( is_array( $size ) || in_array( $size, $lcp_sizes, true ) ) {
				$attr['fetchpriority'] = 'high';
				$attr['loading']       = 'eager';
				unset( $attr['decoding'] );
			}
		}

		// Na innych stronach - pierwszy duży obraz.
		if ( ! is_front_page() && 1 === $this->image_count ) {
			if ( is_array( $size ) || in_array( $size, $lcp_sizes, true ) ) {
				$attr['fetchpriority'] = 'high';
				$attr['loading']       = 'eager';
			}
		}

		return $attr;
	}

	/**
	 * Dodaj MIME type dla WebP.
	 *
	 * @param array $mimes MIME types.
	 * @return array
	 */
	public function add_webp_mime( $mimes ) {
		$mimes['webp'] = 'image/webp';
		return $mimes;
	}

	/**
	 * Dodaj MIME type dla AVIF.
	 *
	 * @param array $mimes MIME types.
	 * @return array
	 */
	public function add_avif_mime( $mimes ) {
		$mimes['avif'] = 'image/avif';
		return $mimes;
	}

	/**
	 * Dodaj srcset z WebP.
	 *
	 * @param array        $attr       Atrybuty.
	 * @param WP_Post      $attachment Załącznik.
	 * @param string|array $size       Rozmiar.
	 * @return array
	 */
	public function add_webp_srcset( $attr, $attachment, $size ) {
		// WebP Express lub inne pluginy mogą obsługiwać to lepiej.
		// Ta funkcja jest placeholder dla manualnej implementacji.
		return $attr;
	}

	/**
	 * Lazy load iframes.
	 *
	 * @param string $content Treść.
	 * @return string
	 */
	public function lazy_load_iframes( $content ) {
		// Dodaj loading="lazy" do iframe.
		return preg_replace(
			'/<iframe(?![^>]*loading\s*=)([^>]*)>/i',
			'<iframe loading="lazy"$1>',
			$content
		);
	}

	/**
	 * Lazy load embeds (YouTube, Vimeo).
	 *
	 * @param string $html    HTML embed.
	 * @param string $url     URL.
	 * @param array  $attr    Atrybuty.
	 * @param int    $post_id ID posta.
	 * @return string
	 */
	public function lazy_load_embeds( $html, $url, $attr, $post_id ) {
		// Dodaj loading="lazy" do iframe w embedach.
		if ( strpos( $html, '<iframe' ) !== false && strpos( $html, 'loading=' ) === false ) {
			$html = str_replace( '<iframe', '<iframe loading="lazy"', $html );
		}
		return $html;
	}

	/**
	 * Dodaj decoding="async" do obrazów.
	 *
	 * @param array        $attr       Atrybuty.
	 * @param WP_Post      $attachment Załącznik.
	 * @param string|array $size       Rozmiar.
	 * @return array
	 */
	public function add_decoding_async( $attr, $attachment, $size ) {
		// Nie dodawaj do LCP image.
		if ( isset( $attr['fetchpriority'] ) && 'high' === $attr['fetchpriority'] ) {
			return $attr;
		}

		if ( ! isset( $attr['decoding'] ) ) {
			$attr['decoding'] = 'async';
		}

		return $attr;
	}

	/**
	 * Upewnij się, że alt jest ustawiony.
	 *
	 * @param array        $attr       Atrybuty.
	 * @param WP_Post      $attachment Załącznik.
	 * @param string|array $size       Rozmiar.
	 * @return array
	 */
	public function ensure_alt_attribute( $attr, $attachment, $size ) {
		if ( ! isset( $attr['alt'] ) || empty( $attr['alt'] ) ) {
			// Użyj tytułu załącznika jako alt.
			$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

			if ( empty( $alt ) ) {
				$alt = $attachment->post_title;
			}

			if ( empty( $alt ) ) {
				// Generuj z nazwy pliku.
				$filename = basename( get_attached_file( $attachment->ID ) );
				$alt      = pathinfo( $filename, PATHINFO_FILENAME );
				$alt      = str_replace( array( '-', '_' ), ' ', $alt );
				$alt      = ucfirst( $alt );
			}

			$attr['alt'] = sanitize_text_field( $alt );
		}

		return $attr;
	}

	/**
	 * Napraw puste alt w treści.
	 *
	 * @param string $content Treść.
	 * @return string
	 */
	public function fix_empty_alt_in_content( $content ) {
		if ( empty( $content ) ) {
			return $content;
		}

		// Znajdź obrazy bez alt lub z pustym alt.
		return preg_replace_callback(
			'/<img([^>]*)>/i',
			array( $this, 'fix_image_alt' ),
			$content
		);
	}

	/**
	 * Callback dla naprawy alt.
	 *
	 * @param array $matches Dopasowania.
	 * @return string
	 */
	private function fix_image_alt( $matches ) {
		$tag   = $matches[0];
		$attrs = $matches[1];

		// Sprawdź czy ma alt.
		if ( preg_match( '/alt\s*=\s*["\'][^"\']+["\']/i', $attrs ) ) {
			return $tag; // Ma niepusty alt.
		}

		// Ma pusty alt lub brak alt.
		$alt = '';

		// Spróbuj wygenerować z src.
		if ( preg_match( '/src\s*=\s*["\']([^"\']+)["\']/i', $attrs, $src_match ) ) {
			$src      = $src_match[1];
			$filename = basename( wp_parse_url( $src, PHP_URL_PATH ) );
			$alt      = pathinfo( $filename, PATHINFO_FILENAME );
			$alt      = str_replace( array( '-', '_' ), ' ', $alt );
			$alt      = ucfirst( trim( $alt ) );

			// Usuń numery i -scaled.
			$alt = preg_replace( '/-?\d+x\d+$/', '', $alt );
			$alt = preg_replace( '/-?scaled$/', '', $alt );
		}

		// Jeśli brak alt.
		if ( preg_match( '/alt\s*=\s*["\']["\']/i', $attrs ) ) {
			// Zamień pusty alt.
			$attrs = preg_replace( '/alt\s*=\s*["\']["\']/i', 'alt="' . esc_attr( $alt ) . '"', $attrs );
		} else {
			// Dodaj alt.
			$attrs .= ' alt="' . esc_attr( $alt ) . '"';
		}

		return '<img' . $attrs . '>';
	}

	/**
	 * Optymalizuj featured image.
	 *
	 * @param string       $html          HTML.
	 * @param int          $post_id       ID posta.
	 * @param int          $thumbnail_id  ID miniaturki.
	 * @param string|array $size          Rozmiar.
	 * @param array        $attr          Atrybuty.
	 * @return string
	 */
	public function optimize_featured_image( $html, $post_id, $thumbnail_id, $size, $attr ) {
		// Dodaj fetchpriority="high" do featured image na pojedynczej stronie.
		if ( is_singular() && in_the_loop() && is_main_query() ) {
			if ( strpos( $html, 'fetchpriority' ) === false ) {
				$html = str_replace( '<img', '<img fetchpriority="high" loading="eager"', $html );
			}
		}

		return $html;
	}

	/**
	 * Preload hero image na stronie głównej.
	 */
	public function preload_hero_image() {
		if ( ! is_front_page() ) {
			return;
		}

		// Sprawdź różne formaty.
		$hero_paths = array(
			'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.avif'  => 'image/avif',
			'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.webp'  => 'image/webp',
			'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.jpg'   => 'image/jpeg',
			'/wp-content/uploads/2025/12/hero-hotel.avif'            => 'image/avif',
			'/wp-content/uploads/2025/12/hero-hotel.webp'            => 'image/webp',
			'/wp-content/uploads/2025/12/hero-hotel.jpg'             => 'image/jpeg',
		);

		foreach ( $hero_paths as $path => $type ) {
			$full_path = ABSPATH . ltrim( $path, '/' );
			if ( file_exists( $full_path ) ) {
				echo '<link rel="preload" as="image" href="' . esc_url( home_url( $path ) ) . '" type="' . esc_attr( $type ) . '" fetchpriority="high">' . "\n";
				return;
			}
		}

		// Fallback - użyj featured image strony głównej.
		$front_page_id = get_option( 'page_on_front' );
		if ( $front_page_id && has_post_thumbnail( $front_page_id ) ) {
			$thumbnail_id = get_post_thumbnail_id( $front_page_id );
			$image_src    = wp_get_attachment_image_src( $thumbnail_id, 'full' );

			if ( $image_src ) {
				$type = 'image/jpeg';
				if ( strpos( $image_src[0], '.webp' ) !== false ) {
					$type = 'image/webp';
				} elseif ( strpos( $image_src[0], '.avif' ) !== false ) {
					$type = 'image/avif';
				} elseif ( strpos( $image_src[0], '.png' ) !== false ) {
					$type = 'image/png';
				}

				echo '<link rel="preload" as="image" href="' . esc_url( $image_src[0] ) . '" type="' . esc_attr( $type ) . '" fetchpriority="high">' . "\n";
			}
		}
	}

	/**
	 * Pomiń lazy loading dla LCP image.
	 *
	 * @param string $value   Wartość loading.
	 * @param string $image   Tag obrazu.
	 * @param string $context Kontekst.
	 * @return string|false
	 */
	public function skip_lazy_for_lcp( $value, $image, $context ) {
		// Pomiń lazy loading dla obrazów z fetchpriority="high".
		if ( strpos( $image, 'fetchpriority="high"' ) !== false ) {
			return false;
		}

		// Pomiń lazy loading dla pierwszego obrazu w treści.
		static $first_image = true;
		if ( 'the_content' === $context && $first_image ) {
			$first_image = false;

			// Sprawdź czy to duży obraz.
			if ( preg_match( '/width\s*=\s*["\'](\d+)["\']/i', $image, $matches ) ) {
				$width = (int) $matches[1];
				if ( $width >= 600 ) {
					return false; // Nie dodawaj lazy loading.
				}
			}
		}

		return $value;
	}
}

// Inicjalizacja.
HND_Images_Module::get_instance();

/**
 * Pomocnicza funkcja do pobierania WebP wersji obrazu.
 *
 * @param string $image_url URL obrazu.
 * @return string|false WebP URL lub false.
 */
function hnd_get_webp_url( $image_url ) {
	$webp_url = preg_replace( '/\.(jpe?g|png)$/i', '.webp', $image_url );

	// Sprawdź czy WebP istnieje.
	$upload_dir = wp_upload_dir();
	$webp_path  = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $webp_url );

	if ( file_exists( $webp_path ) ) {
		return $webp_url;
	}

	return false;
}

/**
 * Pomocnicza funkcja do pobierania AVIF wersji obrazu.
 *
 * @param string $image_url URL obrazu.
 * @return string|false AVIF URL lub false.
 */
function hnd_get_avif_url( $image_url ) {
	$avif_url = preg_replace( '/\.(jpe?g|png|webp)$/i', '.avif', $image_url );

	// Sprawdź czy AVIF istnieje.
	$upload_dir = wp_upload_dir();
	$avif_path  = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $avif_url );

	if ( file_exists( $avif_path ) ) {
		return $avif_url;
	}

	return false;
}
