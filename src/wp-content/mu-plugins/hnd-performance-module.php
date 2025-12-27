<?php
/**
 * Plugin Name: HND Performance Module
 * Description: Moduł optymalizacji wydajności - cache, kompresja, lazy loading, defer JS, preload hints.
 * Version: 2.0.0
 * Author: PB MEDIA
 *
 * @package HND_Performance_Module
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Klasa modułu wydajności.
 */
class HND_Performance_Module {

	/**
	 * Instancja singletona.
	 *
	 * @var HND_Performance_Module
	 */
	private static $instance = null;

	/**
	 * Referencja do głównego optymalizatora.
	 *
	 * @var HND_PageSpeed_Optimizer
	 */
	private $optimizer = null;

	/**
	 * Pobierz instancję.
	 *
	 * @return HND_Performance_Module
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Konstruktor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ), 20 );
	}

	/**
	 * Inicjalizacja po załadowaniu pluginów.
	 */
	public function init() {
		// Sprawdź czy główny optymalizator istnieje.
		if ( class_exists( 'HND_PageSpeed_Optimizer' ) ) {
			$this->optimizer = HND_PageSpeed_Optimizer::get_instance();
		}

		$this->init_hooks();
	}

	/**
	 * Sprawdź czy funkcja jest włączona.
	 *
	 * @param string $key Klucz ustawienia.
	 * @return bool
	 */
	private function is_enabled( $key ) {
		if ( $this->optimizer && method_exists( $this->optimizer, 'is_enabled' ) ) {
			return $this->optimizer->is_enabled( $key );
		}
		// Domyślnie włączone jeśli brak optymalizatora.
		return true;
	}

	/**
	 * Inicjalizuj hooki.
	 */
	private function init_hooks() {
		// 1. Browser Cache - nagłówki HTTP.
		if ( $this->is_enabled( 'enable_browser_cache' ) ) {
			add_action( 'send_headers', array( $this, 'add_cache_headers' ) );
		}

		// 2. Preload Hints.
		if ( $this->is_enabled( 'enable_preload_hints' ) ) {
			add_action( 'wp_head', array( $this, 'add_preload_hints' ), 1 );
		}

		// 3. DNS Prefetch.
		if ( $this->is_enabled( 'enable_dns_prefetch' ) ) {
			add_action( 'wp_head', array( $this, 'add_dns_prefetch' ), 1 );
		}

		// 4. Defer JavaScript.
		if ( $this->is_enabled( 'enable_defer_js' ) ) {
			add_filter( 'script_loader_tag', array( $this, 'add_defer_async' ), 10, 3 );
		}

		// 5. Wyłącz Emojis.
		if ( $this->is_enabled( 'disable_emojis' ) ) {
			add_action( 'init', array( $this, 'disable_emojis' ) );
		}

		// 6. Wyłącz Embed.
		if ( $this->is_enabled( 'disable_embed' ) ) {
			add_action( 'init', array( $this, 'disable_embed' ) );
		}

		// 7. Heartbeat optimization.
		if ( $this->is_enabled( 'disable_heartbeat_frontend' ) ) {
			add_action( 'init', array( $this, 'optimize_heartbeat' ) );
		}

		// 8. Lazy Loading.
		if ( $this->is_enabled( 'enable_lazy_loading' ) ) {
			add_filter( 'wp_lazy_loading_enabled', '__return_true' );
			add_filter( 'the_content', array( $this, 'add_lazy_loading_iframes' ) );
		}

		// 9. Cleanup head.
		add_action( 'init', array( $this, 'cleanup_head' ) );

		// 10. Optymalizacja query strings.
		add_filter( 'style_loader_src', array( $this, 'optimize_asset_urls' ), 10, 2 );
		add_filter( 'script_loader_src', array( $this, 'optimize_asset_urls' ), 10, 2 );

		// 11. Optymalizacja Contact Form 7.
		add_action( 'wp_enqueue_scripts', array( $this, 'optimize_cf7' ), 20 );

		// 12. Wyłącz Dashicons dla niezalogowanych.
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_dashicons' ), 100 );

		// 13. Optymalizacja Gutenberg.
		add_action( 'wp_enqueue_scripts', array( $this, 'optimize_gutenberg' ), 100 );

		// 14. JPEG Quality.
		add_filter( 'jpeg_quality', array( $this, 'set_jpeg_quality' ) );

		// 15. Limit Post Revisions.
		if ( ! defined( 'WP_POST_REVISIONS' ) ) {
			define( 'WP_POST_REVISIONS', 5 );
		}
	}

	/**
	 * Dodaj nagłówki cache.
	 */
	public function add_cache_headers() {
		if ( is_admin() || is_user_logged_in() ) {
			return;
		}

		// Nie cachuj dynamicznych stron.
		if ( is_search() || is_404() ) {
			header( 'Cache-Control: no-cache, no-store, must-revalidate' );
			return;
		}

		// Cache dla statycznych stron.
		$max_age = 3600; // 1 godzina dla HTML.

		if ( is_singular() ) {
			$max_age = 7200; // 2 godziny dla postów/stron.
		}

		if ( is_front_page() ) {
			$max_age = 1800; // 30 minut dla strony głównej.
		}

		header( 'Cache-Control: public, max-age=' . $max_age . ', s-maxage=' . ( $max_age * 2 ) );
		header( 'Vary: Accept-Encoding' );
	}

	/**
	 * Dodaj preload hints.
	 */
	public function add_preload_hints() {
		if ( is_admin() ) {
			return;
		}

		echo "\n<!-- HND Performance: Preload Hints -->\n";

		// Preload krytycznych fontów.
		$fonts = array(
			'/wp-content/themes/flavor/assets/fonts/Jost-Regular.woff2',
			'/wp-content/themes/flavor/assets/fonts/Jost-Medium.woff2',
		);

		foreach ( $fonts as $font ) {
			$font_path = ABSPATH . ltrim( $font, '/' );
			if ( file_exists( $font_path ) ) {
				echo '<link rel="preload" href="' . esc_url( home_url( $font ) ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
			}
		}

		// Preload LCP image na stronie głównej.
		if ( is_front_page() ) {
			$hero_images = array(
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.avif',
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.webp',
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.jpg',
			);

			foreach ( $hero_images as $img ) {
				$img_path = ABSPATH . ltrim( $img, '/' );
				if ( file_exists( $img_path ) ) {
					$type = '';
					if ( strpos( $img, '.avif' ) !== false ) {
						$type = 'image/avif';
					} elseif ( strpos( $img, '.webp' ) !== false ) {
						$type = 'image/webp';
					} else {
						$type = 'image/jpeg';
					}
					echo '<link rel="preload" as="image" href="' . esc_url( home_url( $img ) ) . '" type="' . esc_attr( $type ) . '" fetchpriority="high">' . "\n";
					break;
				}
			}
		}

		// Preload krytycznego CSS.
		$critical_css = array(
			'/wp-content/plugins/oxygen/component-framework/oxygen.css',
		);

		foreach ( $critical_css as $css ) {
			$css_path = ABSPATH . ltrim( $css, '/' );
			if ( file_exists( $css_path ) ) {
				echo '<link rel="preload" href="' . esc_url( home_url( $css ) ) . '" as="style">' . "\n";
			}
		}
	}

	/**
	 * Dodaj DNS prefetch.
	 */
	public function add_dns_prefetch() {
		if ( is_admin() ) {
			return;
		}

		echo "\n<!-- HND Performance: DNS Prefetch -->\n";

		$domains = array(
			'https://fonts.googleapis.com',
			'https://fonts.gstatic.com',
			'https://www.google-analytics.com',
			'https://www.googletagmanager.com',
			'https://maps.googleapis.com',
			'https://nfhotel.pl',
			'https://grafik.nfhotel.pl',
			'https://booking.nfhotel.pl',
		);

		foreach ( $domains as $domain ) {
			echo '<link rel="dns-prefetch" href="' . esc_url( $domain ) . '">' . "\n";
			echo '<link rel="preconnect" href="' . esc_url( $domain ) . '" crossorigin>' . "\n";
		}
	}

	/**
	 * Dodaj defer/async do skryptów.
	 *
	 * @param string $tag    Tag skryptu.
	 * @param string $handle Uchwyt skryptu.
	 * @param string $src    URL źródłowy.
	 * @return string
	 */
	public function add_defer_async( $tag, $handle, $src ) {
		if ( is_admin() ) {
			return $tag;
		}

		// Skrypty do pominięcia (krytyczne).
		$skip = array(
			'jquery',
			'jquery-core',
			'jquery-migrate',
			'oxygen',
			'ct-scripts',
			'oxygen-aos',
			'aos',
			'oxy-gsap',
			'waypoints',
			'wp-i18n',
			'lodash',
			'mainwp-child',
		);

		if ( in_array( $handle, $skip, true ) ) {
			return $tag;
		}

		// Skrypty do async.
		$async = array(
			'google-analytics',
			'gtm',
			'gtag',
			'clarity',
			'google-recaptcha',
		);

		if ( in_array( $handle, $async, true ) ) {
			return str_replace( ' src', ' async src', $tag );
		}

		// Skrypty do defer.
		$defer = array(
			'contact-form-7',
			'wp-embed',
			'comment-reply',
		);

		if ( in_array( $handle, $defer, true ) ) {
			return str_replace( ' src', ' defer src', $tag );
		}

		// Domyślnie dodaj defer do pozostałych skryptów.
		if ( strpos( $tag, 'defer' ) === false && strpos( $tag, 'async' ) === false ) {
			return str_replace( ' src', ' defer src', $tag );
		}

		return $tag;
	}

	/**
	 * Wyłącz WordPress Emojis.
	 */
	public function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

		// Usuń DNS prefetch dla emoji CDN.
		add_filter( 'wp_resource_hints', array( $this, 'remove_emoji_dns_prefetch' ), 10, 2 );

		// Usuń emoji z TinyMCE.
		add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojis_tinymce' ) );
	}

	/**
	 * Usuń DNS prefetch dla emoji.
	 *
	 * @param array  $urls          URLs.
	 * @param string $relation_type Typ relacji.
	 * @return array
	 */
	public function remove_emoji_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$urls = array_filter( $urls, function( $url ) {
				return strpos( $url, 'https://s.w.org/images/core/emoji/' ) === false;
			});
		}
		return $urls;
	}

	/**
	 * Wyłącz emoji w TinyMCE.
	 *
	 * @param array $plugins Pluginy TinyMCE.
	 * @return array
	 */
	public function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		}
		return $plugins;
	}

	/**
	 * Wyłącz WordPress Embed.
	 */
	public function disable_embed() {
		// Usuń skrypt embed.
		wp_deregister_script( 'wp-embed' );

		// Usuń akcje związane z embed.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_action( 'rest_api_init', 'wp_oembed_register_route' );
		remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

		// Usuń endpoint oEmbed.
		add_filter( 'embed_oembed_discover', '__return_false' );

		// Usuń link z nagłówka.
		add_filter( 'rewrite_rules_array', array( $this, 'disable_embed_rewrites' ) );
	}

	/**
	 * Usuń reguły embed z rewrite rules.
	 *
	 * @param array $rules Reguły.
	 * @return array
	 */
	public function disable_embed_rewrites( $rules ) {
		foreach ( $rules as $rule => $rewrite ) {
			if ( strpos( $rewrite, 'embed=true' ) !== false ) {
				unset( $rules[ $rule ] );
			}
		}
		return $rules;
	}

	/**
	 * Optymalizuj Heartbeat.
	 */
	public function optimize_heartbeat() {
		// Wyłącz na frontendzie.
		if ( ! is_admin() ) {
			wp_deregister_script( 'heartbeat' );
			return;
		}

		// Optymalizuj w adminie.
		if ( $this->is_enabled( 'optimize_heartbeat_admin' ) ) {
			add_filter( 'heartbeat_settings', function( $settings ) {
				$settings['interval'] = 60; // 60 sekund zamiast domyślnych 15.
				return $settings;
			});
		}
	}

	/**
	 * Dodaj lazy loading do iframe.
	 *
	 * @param string $content Treść.
	 * @return string
	 */
	public function add_lazy_loading_iframes( $content ) {
		// Dodaj loading="lazy" do iframe bez tego atrybutu.
		return preg_replace(
			'/<iframe(?![^>]*loading=)([^>]*)>/i',
			'<iframe loading="lazy"$1>',
			$content
		);
	}

	/**
	 * Cleanup WordPress head.
	 */
	public function cleanup_head() {
		// Usuń generator meta tag.
		remove_action( 'wp_head', 'wp_generator' );

		// Usuń RSD link.
		remove_action( 'wp_head', 'rsd_link' );

		// Usuń wlwmanifest link.
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Usuń shortlink.
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );

		// Usuń REST API link.
		remove_action( 'wp_head', 'rest_output_link_wp_head' );

		// Usuń feed links.
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );

		// Usuń adjacent posts links.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
	}

	/**
	 * Optymalizuj URL-e zasobów.
	 *
	 * @param string $src    URL źródłowy.
	 * @param string $handle Uchwyt.
	 * @return string
	 */
	public function optimize_asset_urls( $src, $handle ) {
		// Nie modyfikuj w adminie.
		if ( is_admin() ) {
			return $src;
		}

		// Lista plików, których wersję zachowujemy (ważne dla cache busting).
		$keep_version = array(
			'oxygen',
			'ct-scripts',
			'jquery',
		);

		foreach ( $keep_version as $name ) {
			if ( strpos( $handle, $name ) !== false ) {
				return $src;
			}
		}

		// Opcjonalnie: usuń query strings (może powodować problemy z cache).
		// Domyślnie wyłączone.
		// $src = remove_query_arg( 'ver', $src );

		return $src;
	}

	/**
	 * Optymalizuj Contact Form 7.
	 */
	public function optimize_cf7() {
		// Sprawdź czy CF7 jest aktywny.
		if ( ! class_exists( 'WPCF7' ) ) {
			return;
		}

		// Strony z formularzem.
		$contact_pages = array( 'kontakt', 'contact', 'rezerwacja', 'zapytaj' );

		// Sprawdź czy formularz jest potrzebny.
		$has_form = false;

		// Sprawdź shortcode w treści.
		global $post;
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7' ) ) {
			$has_form = true;
		}

		// Sprawdź slug strony.
		if ( is_singular() ) {
			$slug = get_post_field( 'post_name', get_queried_object_id() );
			foreach ( $contact_pages as $page ) {
				if ( strpos( $slug, $page ) !== false ) {
					$has_form = true;
					break;
				}
			}
		}

		// Usuń skrypty CF7 jeśli niepotrzebne.
		if ( ! $has_form ) {
			wp_dequeue_script( 'contact-form-7' );
			wp_dequeue_script( 'google-recaptcha' );
			wp_dequeue_script( 'wpcf7-recaptcha' );
			wp_dequeue_style( 'contact-form-7' );
		}
	}

	/**
	 * Wyłącz Dashicons dla niezalogowanych.
	 */
	public function dequeue_dashicons() {
		if ( ! is_user_logged_in() && ! is_admin_bar_showing() ) {
			wp_dequeue_style( 'dashicons' );
		}
	}

	/**
	 * Optymalizuj Gutenberg.
	 */
	public function optimize_gutenberg() {
		// Sprawdź czy strona używa bloków.
		global $post;

		if ( ! is_a( $post, 'WP_Post' ) ) {
			return;
		}

		// Jeśli treść nie zawiera bloków Gutenberga.
		if ( ! has_blocks( $post->post_content ) ) {
			wp_dequeue_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library-theme' );
			wp_dequeue_style( 'wc-blocks-style' ); // WooCommerce.
			wp_dequeue_style( 'global-styles' );
		}
	}

	/**
	 * Ustaw jakość JPEG.
	 *
	 * @return int
	 */
	public function set_jpeg_quality() {
		return 82; // Dobry balans jakość/rozmiar.
	}
}

// Inicjalizacja.
HND_Performance_Module::get_instance();

/**
 * Dodatkowe optymalizacje wydajności.
 */

// Wyłącz XML-RPC.
add_filter( 'xmlrpc_enabled', '__return_false' );

// Wyłącz REST API dla niezalogowanych (z wyjątkami).
add_filter( 'rest_authentication_errors', function( $result ) {
	if ( is_user_logged_in() ) {
		return $result;
	}

	// Pozwól na niektóre endpointy.
	$allowed = array(
		'/wp-json/contact-form-7/',
		'/wp-json/oembed/',
	);

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

	foreach ( $allowed as $endpoint ) {
		if ( strpos( $request_uri, $endpoint ) !== false ) {
			return $result;
		}
	}

	// Blokuj /users endpoint.
	if ( strpos( $request_uri, '/wp-json/wp/v2/users' ) !== false ) {
		return new WP_Error( 'rest_forbidden', 'Dostęp zabroniony', array( 'status' => 403 ) );
	}

	return $result;
});

/**
 * Cleanup expired transients.
 */
add_action( 'wp_scheduled_delete', function() {
	global $wpdb;

	$wpdb->query(
		$wpdb->prepare(
			"DELETE a, b FROM {$wpdb->options} a, {$wpdb->options} b
			WHERE a.option_name LIKE %s
			AND a.option_name NOT LIKE %s
			AND b.option_name = CONCAT( '_transient_timeout_', SUBSTRING( a.option_name, 12 ) )
			AND b.option_value < %d",
			$wpdb->esc_like( '_transient_' ) . '%',
			$wpdb->esc_like( '_transient_timeout_' ) . '%',
			time()
		)
	);
});
