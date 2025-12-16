<?php
/**
 * Plugin Name: PB MEDIA - Hotel Nowy Dwór Security Hardening
 * Description: Zabezpieczenia WordPress: ukrycie wersji, ochrona przed atakami, Content Security Policy, nagłówki bezpieczeństwa.
 * Version: 1.0
 * Author: PB MEDIA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Główna klasa zabezpieczeń.
 */
class Hotel_Nowydwor_Security {

	/**
	 * Konstruktor.
	 */
	public function __construct() {
		// Ukryj wersję WordPress.
		add_action( 'init', array( $this, 'hide_wp_version' ) );

		// Nagłówki bezpieczeństwa.
		add_action( 'send_headers', array( $this, 'add_security_headers' ) );

		// Wyłącz XML-RPC.
		add_filter( 'xmlrpc_enabled', '__return_false' );
		add_filter( 'xmlrpc_methods', '__return_empty_array' );

		// Wyłącz pingback.
		add_filter( 'wp_headers', array( $this, 'remove_pingback_header' ) );
		add_action( 'pre_ping', array( $this, 'disable_self_pingbacks' ) );

		// Ukryj błędy logowania.
		add_filter( 'login_errors', array( $this, 'hide_login_errors' ) );

		// Ogranicz próby logowania.
		add_action( 'wp_login_failed', array( $this, 'log_failed_login' ) );
		add_filter( 'authenticate', array( $this, 'check_login_attempts' ), 30, 3 );

		// Wyłącz REST API dla niezalogowanych (opcjonalnie).
		add_filter( 'rest_authentication_errors', array( $this, 'restrict_rest_api' ) );

		// Wyłącz autor enumeration.
		add_action( 'template_redirect', array( $this, 'prevent_author_enumeration' ) );

		// Zabezpiecz upload directory.
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'check_upload_type' ), 10, 4 );

		// Wyłącz edycję plików z panelu admina.
		if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
			define( 'DISALLOW_FILE_EDIT', true );
		}

		// Wyłącz instalację pluginów z panelu admina (w produkcji).
		// if ( ! defined( 'DISALLOW_FILE_MODS' ) ) {
		// 	define( 'DISALLOW_FILE_MODS', true );
		// }

		// Wymuś SSL w panelu admina.
		if ( ! defined( 'FORCE_SSL_ADMIN' ) && ! is_ssl() && isset( $_SERVER['HTTP_HOST'] ) && strpos( $_SERVER['HTTP_HOST'], 'localhost' ) === false ) {
			define( 'FORCE_SSL_ADMIN', true );
		}

		// Blokuj dostęp do wrażliwych plików.
		add_action( 'init', array( $this, 'block_sensitive_files' ) );

		// Content Security Policy via meta tag (jeśli .htaccess nie działa).
		add_action( 'wp_head', array( $this, 'add_csp_meta_tag' ), 0 );

		// Nonce dla formularzy.
		add_action( 'login_form', array( $this, 'add_login_nonce' ) );

		// Limit czasu sesji.
		add_filter( 'auth_cookie_expiration', array( $this, 'limit_session_time' ) );

		// Wyłącz komentarze jeśli nie używane.
		// add_filter( 'comments_open', '__return_false', 20, 2 );
		// add_filter( 'pings_open', '__return_false', 20, 2 );
	}

	/**
	 * Ukryj wersję WordPress.
	 */
	public function hide_wp_version() {
		// Usuń generator z head.
		remove_action( 'wp_head', 'wp_generator' );

		// Usuń wersję z RSS.
		add_filter( 'the_generator', '__return_empty_string' );

		// Usuń wersję ze skryptów i stylów.
		add_filter( 'style_loader_src', array( $this, 'remove_version_from_assets' ), 9999 );
		add_filter( 'script_loader_src', array( $this, 'remove_version_from_assets' ), 9999 );
	}

	/**
	 * Usuń wersję z URL zasobów.
	 */
	public function remove_version_from_assets( $src ) {
		if ( strpos( $src, 'ver=' ) !== false ) {
			$src = remove_query_arg( 'ver', $src );
		}
		return $src;
	}

	/**
	 * Dodaj nagłówki bezpieczeństwa.
	 */
	public function add_security_headers() {
		// Nie wysyłaj nagłówków w panelu admina (może powodować problemy).
		if ( is_admin() ) {
			return;
		}

		// X-Content-Type-Options - zapobiegaj MIME sniffing.
		header( 'X-Content-Type-Options: nosniff' );

		// X-Frame-Options - zapobiegaj clickjacking.
		header( 'X-Frame-Options: SAMEORIGIN' );

		// X-XSS-Protection - włącz filtr XSS (dla starszych przeglądarek).
		header( 'X-XSS-Protection: 1; mode=block' );

		// Referrer-Policy - kontroluj informacje w Referer.
		header( 'Referrer-Policy: strict-origin-when-cross-origin' );

		// Permissions-Policy - wyłącz niepotrzebne API.
		header( 'Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), gyroscope=(), accelerometer=()' );

		// Strict-Transport-Security (HSTS) - wymuszaj HTTPS.
		// Uwaga: używaj tylko jeśli masz certyfikat SSL i zawsze będziesz używać HTTPS.
		if ( is_ssl() ) {
			header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );
		}

		// Content-Security-Policy - kontroluj źródła zasobów.
		// Uwaga: dostosuj do swoich potrzeb.
		$csp = $this->get_content_security_policy();
		if ( $csp ) {
			header( 'Content-Security-Policy: ' . $csp );
		}

		// Cross-Origin-Embedder-Policy.
		// header( 'Cross-Origin-Embedder-Policy: require-corp' );

		// Cross-Origin-Opener-Policy.
		header( 'Cross-Origin-Opener-Policy: same-origin' );

		// Cross-Origin-Resource-Policy.
		header( 'Cross-Origin-Resource-Policy: same-origin' );
	}

	/**
	 * Pobierz Content Security Policy.
	 */
	private function get_content_security_policy() {
		// W środowisku lokalnym/dev - wyłącz CSP (może blokować zasoby).
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			return '';
		}

		// Sprawdź czy to localhost - nie stosuj CSP.
		$host = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '';
		if ( strpos( $host, 'localhost' ) !== false || strpos( $host, '127.0.0.1' ) !== false ) {
			return '';
		}

		$csp = array(
			"default-src 'self'",
			"script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com https://maps.googleapis.com https://ajax.googleapis.com https://connect.facebook.net https://www.google.com https://www.gstatic.com https://nfhotel.pl https://booking.nfhotel.pl https://*.smarthost.pl",
			"style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://*.smarthost.pl",
			"img-src 'self' data: https: blob:",
			"font-src 'self' https://fonts.gstatic.com data:",
			"connect-src 'self' https://www.google-analytics.com https://stats.g.doubleclick.net https://region1.google-analytics.com https://*.google-analytics.com",
			"frame-src 'self' https://www.google.com https://maps.google.com https://www.youtube.com https://player.vimeo.com https://www.facebook.com",
			"frame-ancestors 'self'",
			"form-action 'self'",
			"base-uri 'self'",
			"object-src 'none'",
		);

		return implode( '; ', $csp );
	}

	/**
	 * Dodaj CSP jako meta tag (backup).
	 */
	public function add_csp_meta_tag() {
		// CSP jako meta tag działa tylko dla niektórych dyrektyw.
		// Lepsze jest używanie nagłówka HTTP.
		// echo '<meta http-equiv="Content-Security-Policy" content="' . esc_attr( $this->get_content_security_policy() ) . '">';
	}

	/**
	 * Usuń nagłówek X-Pingback.
	 */
	public function remove_pingback_header( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}

	/**
	 * Wyłącz self pingbacks.
	 */
	public function disable_self_pingbacks( &$links ) {
		$home = get_option( 'home' );
		foreach ( $links as $l => $link ) {
			if ( 0 === strpos( $link, $home ) ) {
				unset( $links[ $l ] );
			}
		}
	}

	/**
	 * Ukryj błędy logowania.
	 */
	public function hide_login_errors( $error ) {
		// Nie ujawniaj czy użytkownik istnieje.
		return __( 'Nieprawidłowe dane logowania. Spróbuj ponownie.', 'hotel-nowydwor' );
	}

	/**
	 * Loguj nieudane próby logowania.
	 */
	public function log_failed_login( $username ) {
		$ip = $this->get_client_ip();
		$transient_key = 'failed_login_' . md5( $ip );

		// Pobierz aktualną liczbę prób.
		$attempts = get_transient( $transient_key );
		$attempts = $attempts ? (int) $attempts + 1 : 1;

		// Zapisz z czasem wygaśnięcia (15 minut).
		set_transient( $transient_key, $attempts, 15 * MINUTE_IN_SECONDS );

		// Loguj do pliku.
		if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
			error_log( sprintf(
				'[Security] Failed login attempt for user "%s" from IP %s (attempt #%d)',
				sanitize_user( $username ),
				$ip,
				$attempts
			) );
		}
	}

	/**
	 * Sprawdź liczbę prób logowania.
	 */
	public function check_login_attempts( $user, $username, $password ) {
		// Pomiń jeśli już jest błąd.
		if ( is_wp_error( $user ) ) {
			return $user;
		}

		$ip = $this->get_client_ip();
		$transient_key = 'failed_login_' . md5( $ip );
		$attempts = get_transient( $transient_key );

		// Limit prób (5 prób na 15 minut).
		$max_attempts = 5;

		if ( $attempts && (int) $attempts >= $max_attempts ) {
			return new WP_Error(
				'too_many_attempts',
				sprintf(
					__( 'Zbyt wiele nieudanych prób logowania. Spróbuj ponownie za %d minut.', 'hotel-nowydwor' ),
					15
				)
			);
		}

		return $user;
	}

	/**
	 * Pobierz IP klienta.
	 */
	private function get_client_ip() {
		$ip_keys = array(
			'HTTP_CF_CONNECTING_IP', // Cloudflare.
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
			'REMOTE_ADDR',
		);

		foreach ( $ip_keys as $key ) {
			if ( isset( $_SERVER[ $key ] ) ) {
				$ip = sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) );
				// Obsługa wielu IP (proxy chain).
				if ( strpos( $ip, ',' ) !== false ) {
					$ip = trim( explode( ',', $ip )[0] );
				}
				if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
					return $ip;
				}
			}
		}

		return '0.0.0.0';
	}

	/**
	 * Ogranicz dostęp do REST API.
	 */
	public function restrict_rest_api( $result ) {
		// Pozwól na dostęp dla zalogowanych użytkowników.
		if ( is_user_logged_in() ) {
			return $result;
		}

		// Pozwól na dostęp do niektórych endpointów (np. Contact Form 7).
		$allowed_endpoints = array(
			'/wp-json/contact-form-7/',
			'/wp-json/oembed/',
		);

		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

		foreach ( $allowed_endpoints as $endpoint ) {
			if ( strpos( $request_uri, $endpoint ) !== false ) {
				return $result;
			}
		}

		// Blokuj dostęp do wrażliwych endpointów.
		$blocked_endpoints = array(
			'/wp-json/wp/v2/users',
		);

		foreach ( $blocked_endpoints as $endpoint ) {
			if ( strpos( $request_uri, $endpoint ) !== false ) {
				return new WP_Error(
					'rest_forbidden',
					__( 'Dostęp zabroniony.', 'hotel-nowydwor' ),
					array( 'status' => 403 )
				);
			}
		}

		return $result;
	}

	/**
	 * Zapobiegaj enumeracji autorów.
	 */
	public function prevent_author_enumeration() {
		// Blokuj dostęp do ?author=X.
		if ( isset( $_GET['author'] ) && is_numeric( $_GET['author'] ) ) {
			wp_redirect( home_url(), 301 );
			exit;
		}
	}

	/**
	 * Sprawdź typy uploadowanych plików.
	 */
	public function check_upload_type( $data, $file, $filename, $mimes ) {
		// Lista niebezpiecznych rozszerzeń.
		$dangerous_extensions = array(
			'php',
			'php3',
			'php4',
			'php5',
			'php7',
			'phtml',
			'phar',
			'exe',
			'sh',
			'bash',
			'cgi',
			'pl',
			'py',
			'asp',
			'aspx',
			'jsp',
			'htaccess',
			'htpasswd',
		);

		$file_extension = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );

		if ( in_array( $file_extension, $dangerous_extensions, true ) ) {
			$data['ext'] = false;
			$data['type'] = false;
		}

		return $data;
	}

	/**
	 * Blokuj dostęp do wrażliwych plików.
	 */
	public function block_sensitive_files() {
		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

		// Lista wrażliwych ścieżek.
		$blocked_paths = array(
			'/wp-config.php',
			'/wp-config-sample.php',
			'/readme.html',
			'/license.txt',
			'/xmlrpc.php',
			'/.htaccess',
			'/.htpasswd',
			'/.git',
			'/.env',
			'/composer.json',
			'/composer.lock',
			'/package.json',
			'/package-lock.json',
		);

		foreach ( $blocked_paths as $path ) {
			if ( strpos( $request_uri, $path ) !== false ) {
				status_header( 403 );
				exit( 'Forbidden' );
			}
		}
	}

	/**
	 * Dodaj nonce do formularza logowania.
	 */
	public function add_login_nonce() {
		wp_nonce_field( 'hotel_nowydwor_login', 'login_nonce' );
	}

	/**
	 * Ogranicz czas sesji.
	 */
	public function limit_session_time( $expiration ) {
		// 12 godzin dla normalnych użytkowników.
		// 24 godziny dla administratorów.
		if ( current_user_can( 'manage_options' ) ) {
			return DAY_IN_SECONDS;
		}
		return 12 * HOUR_IN_SECONDS;
	}
}

// Inicjalizacja.
new Hotel_Nowydwor_Security();

/**
 * Dodaj nagłówki Expect-CT i Feature-Policy przez .htaccess lub serwer.
 * Te nagłówki są lepiej obsługiwane przez konfigurację serwera.
 */

/**
 * Wyłącz ujawnianie wersji PHP.
 */
if ( function_exists( 'header_remove' ) ) {
	add_action( 'wp', function() {
		header_remove( 'X-Powered-By' );
	} );
}

/**
 * Wyczyść output od startu dla czystych nagłówków.
 */
add_action( 'init', function() {
	// Upewnij się, że output buffering nie wycieknie informacji.
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		// ob_start();
	}
}, 1 );

/**
 * Wyłącz trackbacks.
 */
add_filter( 'pings_open', '__return_false', 10, 2 );

/**
 * Bezpieczne cookies.
 */
add_action( 'init', function() {
	// Ustaw secure i httponly dla cookies sesji.
	if ( is_ssl() && ! is_admin() ) {
		ini_set( 'session.cookie_secure', '1' );
		ini_set( 'session.cookie_httponly', '1' );
		ini_set( 'session.cookie_samesite', 'Strict' );
	}
}, 1 );

/**
 * Wyłącz aplikacyjne hasła (WordPress 5.6+).
 */
add_filter( 'wp_is_application_passwords_available', '__return_false' );

/**
 * Ogranicz typy MIME dozwolone przy uploadzie.
 */
add_filter( 'upload_mimes', function( $mimes ) {
	// Usuń potencjalnie niebezpieczne typy.
	unset( $mimes['swf'] );
	unset( $mimes['exe'] );
	unset( $mimes['htm|html'] );

	// Dodaj bezpieczne typy obrazków.
	$mimes['webp'] = 'image/webp';
	$mimes['avif'] = 'image/avif';
	$mimes['svg'] = 'image/svg+xml'; // Uwaga: SVG może zawierać skrypty!

	return $mimes;
} );

/**
 * Sanityzuj SVG uploads (jeśli dozwolone).
 */
add_filter( 'wp_handle_upload_prefilter', function( $file ) {
	if ( $file['type'] === 'image/svg+xml' ) {
		// Sprawdź zawartość SVG pod kątem skryptów.
		$svg_content = file_get_contents( $file['tmp_name'] );

		if ( preg_match( '/<script|javascript:|onclick|onerror|onload/i', $svg_content ) ) {
			$file['error'] = __( 'Plik SVG zawiera potencjalnie niebezpieczną zawartość.', 'hotel-nowydwor' );
		}
	}

	return $file;
} );
