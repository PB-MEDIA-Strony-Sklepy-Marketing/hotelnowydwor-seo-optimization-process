<?php
/**
 * Plugin Name: PB MEDIA - Hotel Nowy Dwór Performance Optimizer (Fixed)
 * Description: Poprawiona optymalizacja: naprawia błędy AOS w Oxygen, usuwa konflikty preload, optymalizuje Core Web Vitals.
 * Version: 1.2
 * Author: PB MEDIA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hotel_Nowydwor_Performance {

	public function __construct() {
		// 1. Resource hints (Preload/Preconnect).
		add_action( 'wp_head', array( $this, 'add_resource_hints' ), 1 );

		// 2. Inteligentny Async/Defer dla skryptów (Naprawiony dla Oxygen).
		add_filter( 'script_loader_tag', array( $this, 'add_async_defer' ), 10, 3 );

		// 3. Wyłącz emoji (zbędny skrypt JS).
		add_action( 'init', array( $this, 'disable_emojis' ) );

		// 4. Czyszczenie nagłówka (Head cleanup).
		add_action( 'init', array( $this, 'clean_wp_head' ) );

		// 5. Optymalizacja Heartbeat.
		add_action( 'init', array( $this, 'optimize_heartbeat' ) );

		// 6. Lazy Load dla Iframe.
		add_filter( 'the_content', array( $this, 'add_lazy_loading_iframes' ) );

		// 7. Cleanup transients (baza danych).
		add_action( 'wp_scheduled_delete', array( $this, 'cleanup_expired_transients' ) );

		// 8. Optymalizacja obrazków (fetchpriority).
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'optimize_image_attributes' ), 10, 3 );

		// 9. Optymalizacja Contact Form 7.
		add_action( 'wp_enqueue_scripts', array( $this, 'optimize_cf7' ), 20 );

		// 10. Wyłącz Dashicons dla niezalogowanych.
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_dashicons' ), 20 );

        // UWAGA: Usunięto funkcję remove_query_strings, która powodowała błędy preloadu w konsoli.
	}

	/**
	 * Dodaj resource hints.
	 */
	public function add_resource_hints() {
		$preconnect_domains = array(
			'https://fonts.googleapis.com',
			'https://fonts.gstatic.com',
			'https://www.google-analytics.com',
			'https://www.googletagmanager.com',
			'https://nfhotel.pl',
			'https://grafik.nfhotel.pl',
		);

		echo "\n<!-- Resource Hints -->\n";
		foreach ( $preconnect_domains as $domain ) {
			echo '<link rel="preconnect" href="' . esc_url( $domain ) . '" crossorigin>' . "\n";
		}

		// Preload LCP Image na stronie głównej (Hero Image)
		if ( is_front_page() ) {
            // Sprawdzamy czy plik istnieje, żeby nie generować 404
			$hero_images = array(
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.avif',
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.webp',
				'/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.jpg',
				'/wp-content/uploads/2025/12/logologo.avif',
				'/wp-content/uploads/2025/12/logologo.webp',
				'/wp-content/uploads/2025/12/logologo.png',
			);

            foreach($hero_images as $img) {
                if ( file_exists( ABSPATH . ltrim( $img, '/' ) ) ) {
                    echo '<link rel="preload" as="image" href="' . esc_url( home_url( $img ) ) . '" fetchpriority="high">' . "\n";
                    break; // Ładujemy tylko pierwszy znaleziony
                }
            }
		}
	}

	/**
	 * Dodaj async/defer - POPRAWIONE DLA OXYGEN I AOS.
	 */
	public function add_async_defer( $tag, $handle, $src ) {
		// Lista skryptów, których NIE WOLNO opóźniać (krytyczne dla Oxygen/WP).
		$skip_scripts = array(
			'jquery', 
			'jquery-core', 
			'jquery-migrate',
            'oxygen',          // Core Oxygen
            'ct-scripts',      // Core Oxygen Scripts
            'oxygen-aos',      // Oxygen Animation Library (Naprawa błędu AOS)
            'aos',             // Biblioteka AOS (Naprawa błędu AOS)
            'oxy-gsap',        // Oxygen Animations
            'waypoints',       // Używane przy scrollu
            'wp-i18n',
            'lodash',
            'mainwp-child',    // Plugin zarządzający
		);

		// Lista skryptów do DEFER (ładowanie po HTML).
		$defer_scripts = array(
			'contact-form-7',
			'wp-embed',
            'google-recaptcha',
		);

		// Lista skryptów do ASYNC.
		$async_scripts = array(
			'google-analytics',
			'gtm',
			'gtag',
            'clarity',
		);

		if ( is_admin() ) {
			return $tag;
		}

		// 1. Pomiń wykluczone skrypty.
		if ( in_array( $handle, $skip_scripts, true ) ) {
			return $tag;
		}

        // 2. Dodaj Async.
		if ( in_array( $handle, $async_scripts, true ) ) {
			return str_replace( ' src', ' async src', $tag );
		}

        // 3. Dodaj Defer.
		if ( in_array( $handle, $defer_scripts, true ) ) {
            return str_replace( ' src', ' defer src', $tag );
		}

		return $tag;
	}

	/**
	 * Optymalizacja Contact Form 7 - ładuj tylko na stronach kontaktu.
	 */
	public function optimize_cf7() {
        // Zmień te slugi na poprawne dla Twojej strony
		$contact_pages = array( 'kontakt', 'contact', 'rezerwacja', 'zapytaj-o-nocleg' );
		
        // Sprawdź czy to strona, post lub czy zawiera shortcode formularza
        global $post;
        $has_form = false;

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7' ) ) {
            $has_form = true;
        }

        if ( is_singular() ) {
            $slug = get_post_field( 'post_name', get_queried_object_id() );
            if ( in_array( $slug, $contact_pages, true ) ) {
                $has_form = true;
            }
        }

		if ( ! $has_form ) {
			wp_dequeue_script( 'contact-form-7' );
            wp_dequeue_script( 'google-recaptcha' );
            wp_dequeue_script( 'wpcf7-recaptcha' );
			wp_dequeue_style( 'contact-form-7' );
		}
	}

    /**
     * Wyłącz Dashicons na froncie (chyba że admin bar jest widoczny).
     */
    public function dequeue_dashicons() {
        if ( ! is_user_logged_in() && ! is_admin_bar_showing() ) {
            wp_dequeue_style( 'dashicons' );
        }
    }

	/**
	 * Wyłącz Emojis.
	 */
	public function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	/**
	 * Cleanup Head.
	 */
	public function clean_wp_head() {
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	}

	/**
	 * Heartbeat Optimization.
	 */
	public function optimize_heartbeat() {
		if ( ! is_admin() ) {
			wp_deregister_script( 'heartbeat' );
		} else {
            add_filter( 'heartbeat_settings', function( $settings ) {
                $settings['interval'] = 60;
                return $settings;
            });
        }
	}

	/**
	 * Lazy Load iFrames.
	 */
	public function add_lazy_loading_iframes( $content ) {
		return preg_replace(
			'/<iframe(?![^>]*loading=)([^>]*)>/i',
			'<iframe loading="lazy"$1>',
			$content
		);
	}

	/**
	 * Database cleanup (transients).
	 */
	public function cleanup_expired_transients() {
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
	}

	/**
	 * Image Attributes (Fetchpriority & Decoding).
	 */
	public function optimize_image_attributes( $attr, $attachment, $size ) {
		if ( ! isset( $attr['decoding'] ) ) {
			$attr['decoding'] = 'async';
		}
		
        // LCP Optimization dla Hero image
		$lcp_sizes = array( 'full', 'large', '2048x2048' );
		if ( is_front_page() && in_array( $size, $lcp_sizes, true ) ) {
            // Zakładamy, że pierwszy duży obrazek to LCP
            static $lcp_found = false;
            if ( ! $lcp_found ) {
			    $attr['fetchpriority'] = 'high';
			    $attr['loading'] = 'eager'; // Nie lazy loaduj LCP!
                unset($attr['decoding']); // LCP powinno być sync lub auto
                $lcp_found = true;
            }
		}
		return $attr;
	}
}

// Init
new Hotel_Nowydwor_Performance();

// Set Quality
add_filter( 'jpeg_quality', function() { return 82; } );
add_filter( 'xmlrpc_enabled', '__return_false' );

// Revisions limit (Safety check)
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
	define( 'WP_POST_REVISIONS', 5 );
}