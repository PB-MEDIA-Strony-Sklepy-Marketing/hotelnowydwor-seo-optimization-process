<?php
/**
 * Plugin Name: PB MEDIA - Hotel Nowy Dwór Performance Optimizer
 * Description: Optymalizacja wydajności: lazy loading, defer/async skryptów, preload krytycznych zasobów, optymalizacja query.
 * Version: 1.0
 * Author: PB MEDIA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Główna klasa optymalizacji wydajności.
 */
class Hotel_Nowydwor_Performance {

	/**
	 * Konstruktor.
	 */
	public function __construct() {
		// Resource hints.
		add_action( 'wp_head', array( $this, 'add_resource_hints' ), 1 );

		// Defer i async dla skryptów.
		add_filter( 'script_loader_tag', array( $this, 'add_async_defer' ), 10, 3 );

		// Optymalizacja jQuery.
		add_action( 'wp_enqueue_scripts', array( $this, 'optimize_jquery' ), 100 );

		// Wyłącz emoji WordPress.
		add_action( 'init', array( $this, 'disable_emojis' ) );

		// Wyłącz zbędne elementy head.
		add_action( 'init', array( $this, 'clean_wp_head' ) );

		// Optymalizacja Heartbeat API.
		add_action( 'init', array( $this, 'optimize_heartbeat' ) );

		// Lazy load dla iframe.
		add_filter( 'the_content', array( $this, 'add_lazy_loading_iframes' ) );

		// Optymalizacja bazy danych - transients cleanup.
		add_action( 'wp_scheduled_delete', array( $this, 'cleanup_expired_transients' ) );

		// Wyłącz post revisions limit.
		if ( ! defined( 'WP_POST_REVISIONS' ) ) {
			define( 'WP_POST_REVISIONS', 5 );
		}

		// Wyłącz XMLRPC.
		add_filter( 'xmlrpc_enabled', '__return_false' );

		// Usuń query strings z zasobów statycznych.
		add_filter( 'script_loader_src', array( $this, 'remove_query_strings' ), 15 );
		add_filter( 'style_loader_src', array( $this, 'remove_query_strings' ), 15 );

		// Optymalizacja obrazków - dodaj fetchpriority.
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'optimize_image_attributes' ), 10, 3 );

		// Wyłącz generator meta tag.
		remove_action( 'wp_head', 'wp_generator' );

		// Wyłącz shortlink.
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );

		// Wyłącz wlmanifest link.
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Wyłącz RSD link.
		remove_action( 'wp_head', 'rsd_link' );

		// Wyłącz adjacent posts links.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

		// Wyłącz feed links.
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );

		// Wyłącz REST API link w head.
		remove_action( 'wp_head', 'rest_output_link_wp_head' );

		// Wyłącz oEmbed discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	}

	/**
	 * Dodaj resource hints (preconnect, dns-prefetch, preload).
	 */
	public function add_resource_hints() {
		// Preconnect do krytycznych domen.
		$preconnect_domains = array(
			'https://fonts.googleapis.com',
			'https://fonts.gstatic.com',
			'https://www.google-analytics.com',
			'https://www.googletagmanager.com',
			'https://nfhotel.pl',
			'https://grafik.nfhotel.pl',
		);

		echo "\n<!-- Resource Hints - Performance Optimization -->\n";

		foreach ( $preconnect_domains as $domain ) {
			echo '<link rel="preconnect" href="' . esc_url( $domain ) . '" crossorigin>' . "\n";
		}

		// DNS Prefetch dla dodatkowych domen.
		$dns_prefetch = array(
			'//maps.googleapis.com',
			'//ajax.googleapis.com',
			'//cdnjs.cloudflare.com',
			'//nfhotel.pl',
			'//grafik.nfhotel.pl',
		);

		foreach ( $dns_prefetch as $domain ) {
			echo '<link rel="dns-prefetch" href="' . esc_attr( $domain ) . '">' . "\n";
		}

		// Preload krytycznych zasobów na stronie głównej.
		if ( is_front_page() ) {
			// Preload hero image (LCP element).
			$hero_candidates = array(
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.avif',
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.webp',
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.jpg',
				'/wp-content/uploads/2025/12/logologo.avif',
				'/wp-content/uploads/2025/12/logologo.webp',
				'/wp-content/uploads/2025/12/logologo.png',
			);

			foreach ( $hero_candidates as $path ) {
				if ( file_exists( ABSPATH . ltrim( $path, '/' ) ) ) {
					$type = pathinfo( $path, PATHINFO_EXTENSION ) === 'webp' ? 'image/webp' : 'image/jpeg';
					echo '<link rel="preload" as="image" href="' . esc_url( home_url( $path ) ) . '" type="' . esc_attr( $type ) . '" fetchpriority="high">' . "\n";
					break;
				}
			}
		}

		// Preload głównego CSS (jeśli istnieje).
		$critical_css = '/wp-content/themes/flavor/style.css';
		if ( file_exists( ABSPATH . ltrim( $critical_css, '/' ) ) ) {
			echo '<link rel="preload" as="style" href="' . esc_url( home_url( $critical_css ) ) . '">' . "\n";
		}
	}

	/**
	 * Dodaj async/defer do skryptów.
	 */
	public function add_async_defer( $tag, $handle, $src ) {
		// Skrypty do defer (ładowanie po parsowaniu HTML).
		$defer_scripts = array(
			'comment-reply',
			'wp-embed',
			'contact-form-7',
			'google-analytics',
			'gtm',
			'gtag',
		);

		// Skrypty do async (ładowanie asynchroniczne).
		$async_scripts = array(
			'google-analytics',
			'gtag',
		);

		// Skrypty do pominięcia (nie modyfikuj).
		$skip_scripts = array(
			'jquery',
			'jquery-core',
			'jquery-migrate',
			'oxygen',
		);

		// Pomiń skrypty krytyczne.
		if ( in_array( $handle, $skip_scripts, true ) ) {
			return $tag;
		}

		// Dodaj async.
		if ( in_array( $handle, $async_scripts, true ) ) {
			if ( strpos( $tag, 'async' ) === false ) {
				$tag = str_replace( ' src', ' async src', $tag );
			}
			return $tag;
		}

		// Dodaj defer.
		if ( in_array( $handle, $defer_scripts, true ) ) {
			if ( strpos( $tag, 'defer' ) === false && strpos( $tag, 'async' ) === false ) {
				$tag = str_replace( ' src', ' defer src', $tag );
			}
			return $tag;
		}

		// Domyślnie dodaj defer do wszystkich pozostałych skryptów (oprócz inline).
		if ( strpos( $tag, 'defer' ) === false && strpos( $tag, 'async' ) === false && strpos( $src, home_url() ) !== false ) {
			// Tylko dla skryptów lokalnych.
			$tag = str_replace( ' src', ' defer src', $tag );
		}

		return $tag;
	}

	/**
	 * Optymalizacja jQuery.
	 */
	public function optimize_jquery() {
		// Nie optymalizuj w panelu admina.
		if ( is_admin() ) {
			return;
		}

		// Przenieś jQuery do footera (jeśli nie łamie funkcjonalności).
		// Uwaga: może powodować problemy z niektórymi pluginami.
		// wp_scripts()->add_data( 'jquery', 'group', 1 );
		// wp_scripts()->add_data( 'jquery-core', 'group', 1 );
		// wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
	}

	/**
	 * Wyłącz WordPress emoji.
	 */
	public function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

		// Usuń emoji z TinyMCE.
		add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojis_tinymce' ) );

		// Usuń dns-prefetch dla emoji.
		add_filter( 'wp_resource_hints', array( $this, 'disable_emojis_dns_prefetch' ), 10, 2 );
	}

	/**
	 * Wyłącz emoji w TinyMCE.
	 */
	public function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		}
		return array();
	}

	/**
	 * Usuń dns-prefetch dla emoji.
	 */
	public function disable_emojis_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/14.0.0/svg/' );
			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}
		return $urls;
	}

	/**
	 * Wyczyść wp_head z niepotrzebnych elementów.
	 */
	public function clean_wp_head() {
		// Usuń meta generator.
		remove_action( 'wp_head', 'wp_generator' );

		// Usuń Windows Live Writer manifest.
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Usuń RSD link.
		remove_action( 'wp_head', 'rsd_link' );

		// Usuń shortlink.
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );

		// Usuń REST API link.
		remove_action( 'wp_head', 'rest_output_link_wp_head' );

		// Usuń oEmbed discovery.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );

		// Usuń linki do poprzedniego/następnego posta.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

		// Usuń linki do feedów (RSS) - opcjonalnie.
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
	}

	/**
	 * Optymalizacja Heartbeat API.
	 */
	public function optimize_heartbeat() {
		// Wyłącz heartbeat na frontendzie.
		if ( ! is_admin() ) {
			wp_deregister_script( 'heartbeat' );
			return;
		}

		// Zmniejsz częstotliwość heartbeat w panelu admina (z 15s na 60s).
		add_filter( 'heartbeat_settings', function( $settings ) {
			$settings['interval'] = 60;
			return $settings;
		} );
	}

	/**
	 * Dodaj lazy loading do iframe.
	 */
	public function add_lazy_loading_iframes( $content ) {
		// Dodaj loading="lazy" do wszystkich iframe bez tego atrybutu.
		$content = preg_replace(
			'/<iframe(?![^>]*loading=)([^>]*)>/i',
			'<iframe loading="lazy"$1>',
			$content
		);

		return $content;
	}

	/**
	 * Cleanup expired transients.
	 */
	public function cleanup_expired_transients() {
		global $wpdb;

		// Usuń wygasłe transients.
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
	}

	/**
	 * Usuń query strings z zasobów statycznych.
	 */
	public function remove_query_strings( $src ) {
		if ( strpos( $src, '?ver=' ) !== false ) {
			$src = remove_query_arg( 'ver', $src );
		}
		return $src;
	}

	/**
	 * Optymalizuj atrybuty obrazków.
	 */
	public function optimize_image_attributes( $attr, $attachment, $size ) {
		// Dodaj decoding="async" jeśli brak.
		if ( ! isset( $attr['decoding'] ) ) {
			$attr['decoding'] = 'async';
		}

		// Dla dużych obrazków (large, full) nie stosuj lazy loading dla LCP.
		$lcp_sizes = array( 'full', 'large', '1536x1536', '2048x2048' );

		if ( in_array( $size, $lcp_sizes, true ) && is_front_page() ) {
			// Na stronie głównej pierwszy duży obraz to prawdopodobnie LCP.
			$attr['fetchpriority'] = 'high';
			$attr['loading'] = 'eager';
		}

		return $attr;
	}
}

// Inicjalizacja.
new Hotel_Nowydwor_Performance();

/**
 * Dodaj preload dla Google Fonts (jeśli używane).
 */
add_action( 'wp_head', 'hotel_nowydwor_preload_fonts', 1 );
function hotel_nowydwor_preload_fonts() {
	// Przykład preload dla Google Fonts - odkomentuj jeśli używane.
	echo '<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">' . "\n";
}

/**
 * Optymalizacja Contact Form 7 - ładuj tylko na stronie kontakt.
 */
add_action( 'wp_enqueue_scripts', 'hotel_nowydwor_optimize_cf7', 20 );
function hotel_nowydwor_optimize_cf7() {
	// Sprawdź czy to strona z formularzem.
	$contact_pages = array( 'kontakt', 'contact', 'rezerwacja' );
	$current_slug = get_post_field( 'post_name', get_queried_object_id() );

	if ( ! in_array( $current_slug, $contact_pages, true ) ) {
		// Wyłącz CSS i JS Contact Form 7 na stronach bez formularza.
		wp_dequeue_style( 'contact-form-7' );
		wp_dequeue_script( 'contact-form-7' );
		wp_dequeue_script( 'wpcf7-recaptcha' );
	}
}

/**
 * Optymalizacja Gutenberg - wyłącz style blokowe jeśli nie używane.
 */
add_action( 'wp_enqueue_scripts', 'hotel_nowydwor_optimize_gutenberg', 100 );
function hotel_nowydwor_optimize_gutenberg() {
	// Jeśli strona nie używa bloków Gutenberg.
	// Uwaga: Oxygen Builder nie używa Gutenberga.
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' ); // WooCommerce blocks.
	wp_dequeue_style( 'global-styles' ); // WordPress 5.9+ global styles.
}

/**
 * Wyłącz dashicons na frontendzie dla niezalogowanych użytkowników.
 */
add_action( 'wp_enqueue_scripts', 'hotel_nowydwor_dequeue_dashicons' );
function hotel_nowydwor_dequeue_dashicons() {
	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'dashicons' );
	}
}

/**
 * Ustaw limit revisions dla postów.
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
	define( 'WP_POST_REVISIONS', 5 );
}

/**
 * Wyłącz autosave na frontendzie.
 */
add_action( 'wp_enqueue_scripts', 'hotel_nowydwor_disable_autosave' );
function hotel_nowydwor_disable_autosave() {
	wp_deregister_script( 'autosave' );
}

/**
 * Optymalizacja obrazków - ustaw jakość JPEG.
 */
add_filter( 'jpeg_quality', function() {
	return 82; // Balans między jakością a rozmiarem.
} );

/**
 * Dodaj fetchpriority="high" do pierwszego obrazka w treści.
 */
add_filter( 'the_content', 'hotel_nowydwor_optimize_first_image', 99 );
function hotel_nowydwor_optimize_first_image( $content ) {
	// Tylko na stronie głównej i pojedynczych stronach.
	if ( ! is_front_page() && ! is_singular() ) {
		return $content;
	}

	// Znajdź pierwszy obrazek i dodaj fetchpriority="high".
	$content = preg_replace(
		'/(<img[^>]*class="[^"]*)[^>]*>/i',
		'$0',
		$content,
		1
	);

	// Dodaj fetchpriority do pierwszego img bez tego atrybutu.
	$found = false;
	$content = preg_replace_callback(
		'/<img([^>]*)>/i',
		function( $matches ) use ( &$found ) {
			if ( ! $found && strpos( $matches[0], 'fetchpriority' ) === false ) {
				$found = true;
				return '<img fetchpriority="high"' . $matches[1] . '>';
			}
			return $matches[0];
		},
		$content
	);

	return $content;
}
