<?php
/**
 * HND Security Module
 *
 * Moduł bezpieczeństwa dla Hotel Nowy Dwór.
 * Implementuje nagłówki bezpieczeństwa, CSP, ochronę logowania.
 *
 * @package     HND_PageSpeed_Optimizer
 * @subpackage  Security_Module
 * @version     1.0.0
 * @author      Hotel Nowy Dwór
 *
 * INSTRUKCJA DLA POCZĄTKUJĄCYCH:
 * =============================
 * Ten plik automatycznie zwiększa bezpieczeństwo strony:
 *
 * 1. NAGŁÓWKI BEZPIECZEŃSTWA - X-Frame-Options, X-XSS-Protection, etc.
 * 2. CSP - Content Security Policy chroniący przed XSS
 * 3. OCHRONA LOGOWANIA - Limit prób, ukrycie wp-login
 * 4. OCHRONA PLIKÓW - Blokada dostępu do wrażliwych plików
 * 5. SPAM PROTECTION - Honeypot w formularzach
 *
 * Plik działa automatycznie po umieszczeniu w /wp-content/mu-plugins/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Klasa modułu bezpieczeństwa
 */
class HND_Security_Module {

    /**
     * Instancja singletona
     */
    private static $instance = null;

    /**
     * Ustawienia modułu
     */
    private $settings = array();

    /**
     * Pobierz instancję singletona
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Konstruktor
     */
    private function __construct() {
        // Opóźnij pełną inicjalizację, ale niektóre funkcje muszą działać wcześniej.
        add_action( 'plugins_loaded', array( $this, 'delayed_init' ), 25 );

        // Te hooki muszą być dodane wcześniej (przed plugins_loaded).
        $this->load_settings();

        // Wyłącz edytor plików w adminie - musi być przed init.
        if ( $this->settings['disable_file_edit'] && ! defined( 'DISALLOW_FILE_EDIT' ) ) {
            define( 'DISALLOW_FILE_EDIT', true );
        }
    }

    /**
     * Opóźniona inicjalizacja.
     */
    public function delayed_init() {
        // Przeładuj ustawienia (mogły się zmienić).
        $this->load_settings();
        $this->init_hooks();
    }

    /**
     * Załaduj ustawienia
     *
     * Pobiera ustawienia zarówno z głównego optymalizatora,
     * jak i z własnych ustawień modułu Security.
     */
    private function load_settings() {
        $defaults = array(
            'security_headers'     => true,
            'csp_enabled'          => true,
            'csp_report_only'      => false,
            'hide_wp_version'      => true,
            'disable_xmlrpc'       => true,
            'disable_file_edit'    => true,
            'login_protection'     => true,
            'login_max_attempts'   => 5,
            'login_lockout_time'   => 15, // minut
            'honeypot_forms'       => true,
            'block_bad_bots'       => true,
            'secure_cookies'       => true,
            'disable_rest_users'   => true,
            'remove_readme'        => true,
        );

        // Mapowanie ustawień z głównego optymalizatora.
        $optimizer_mapping = array(
            'enable_security_headers' => 'security_headers',
            'enable_csp'              => 'csp_enabled',
            'hide_wp_version'         => 'hide_wp_version',
            'disable_xmlrpc'          => 'disable_xmlrpc',
            'limit_login_attempts'    => 'login_protection',
        );

        // Wyczyść cache opcji, aby zawsze pobierać świeże dane.
        wp_cache_delete( 'hnd_pagespeed_optimizer_settings', 'options' );
        wp_cache_delete( 'hnd_security_settings', 'options' );

        // Pobierz ustawienia z głównego optymalizatora.
        $optimizer_settings = get_option( 'hnd_pagespeed_optimizer_settings', array() );

        // Zastosuj mapowanie.
        foreach ( $optimizer_mapping as $optimizer_key => $local_key ) {
            if ( isset( $optimizer_settings[ $optimizer_key ] ) ) {
                $defaults[ $local_key ] = (bool) $optimizer_settings[ $optimizer_key ];
            }
        }

        // Pobierz własne ustawienia modułu (nadpisują domyślne).
        $saved = get_option( 'hnd_security_settings', array() );
        $this->settings = wp_parse_args( $saved, $defaults );
    }

    /**
     * Inicjalizuj hooki
     */
    private function init_hooks() {
        // Nagłówki bezpieczeństwa
        add_action( 'send_headers', array( $this, 'send_security_headers' ) );

        // Ukryj wersję WordPress
        if ( $this->settings['hide_wp_version'] ) {
            add_filter( 'the_generator', '__return_empty_string' );
            remove_action( 'wp_head', 'wp_generator' );
            add_filter( 'style_loader_src', array( $this, 'remove_version_query' ), 10000 );
            add_filter( 'script_loader_src', array( $this, 'remove_version_query' ), 10000 );
        }

        // Wyłącz XML-RPC
        if ( $this->settings['disable_xmlrpc'] ) {
            add_filter( 'xmlrpc_enabled', '__return_false' );
            add_filter( 'wp_headers', array( $this, 'remove_x_pingback' ) );
        }

        // Uwaga: DISALLOW_FILE_EDIT jest definiowane w konstruktorze,
        // ponieważ musi być zdefiniowane przed załadowaniem admina.

        // Ochrona logowania
        if ( $this->settings['login_protection'] ) {
            add_filter( 'authenticate', array( $this, 'check_login_attempts' ), 30, 3 );
            add_action( 'wp_login_failed', array( $this, 'log_failed_login' ) );
            add_action( 'wp_login', array( $this, 'clear_login_attempts' ), 10, 2 );
        }

        // Honeypot w formularzach
        if ( $this->settings['honeypot_forms'] ) {
            add_action( 'comment_form', array( $this, 'add_honeypot_field' ) );
            add_filter( 'preprocess_comment', array( $this, 'check_honeypot' ) );

            // Contact Form 7
            add_filter( 'wpcf7_form_elements', array( $this, 'add_cf7_honeypot' ) );
            add_filter( 'wpcf7_validate', array( $this, 'validate_cf7_honeypot' ), 10, 2 );
        }

        // Blokuj złe boty
        if ( $this->settings['block_bad_bots'] ) {
            add_action( 'init', array( $this, 'block_bad_bots' ), 1 );
        }

        // Bezpieczne ciasteczka
        if ( $this->settings['secure_cookies'] ) {
            add_action( 'init', array( $this, 'secure_cookies' ) );
        }

        // Wyłącz REST API dla użytkowników (ukryj nazwy użytkowników)
        if ( $this->settings['disable_rest_users'] ) {
            add_filter( 'rest_endpoints', array( $this, 'disable_rest_users_endpoint' ) );
        }

        // Dodatkowe zabezpieczenia
        add_action( 'init', array( $this, 'additional_security' ) );

        // Wyczyść stare wpisy blokady logowania
        add_action( 'wp_scheduled_delete', array( $this, 'cleanup_login_logs' ) );
    }

    /**
     * Wyślij nagłówki bezpieczeństwa
     */
    public function send_security_headers() {
        if ( ! $this->settings['security_headers'] ) {
            return;
        }

        // Tylko dla frontendu (nie dla admina, gdzie może to powodować problemy)
        if ( is_admin() ) {
            return;
        }

        // X-Frame-Options - zapobiega clickjacking
        header( 'X-Frame-Options: SAMEORIGIN' );

        // X-Content-Type-Options - zapobiega MIME sniffing
        header( 'X-Content-Type-Options: nosniff' );

        // X-XSS-Protection - dodatkowa ochrona XSS
        header( 'X-XSS-Protection: 1; mode=block' );

        // Referrer-Policy
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );

        // Permissions-Policy (dawniej Feature-Policy)
        header( 'Permissions-Policy: geolocation=(self), microphone=(), camera=(), payment=(), usb=()' );

        // Strict-Transport-Security (HSTS) - tylko dla HTTPS
        if ( is_ssl() ) {
            header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );
        }

        // Content Security Policy
        if ( $this->settings['csp_enabled'] ) {
            $csp = $this->build_csp();
            $header_name = $this->settings['csp_report_only']
                ? 'Content-Security-Policy-Report-Only'
                : 'Content-Security-Policy';

            header( $header_name . ': ' . $csp );
        }
    }

    /**
     * Zbuduj Content Security Policy
     */
    private function build_csp() {
        $site_url = site_url();
        $parsed = wp_parse_url( $site_url );
        $host = isset( $parsed['host'] ) ? $parsed['host'] : '';

        // Dozwolone źródła
        $self = "'self'";
        $unsafe_inline = "'unsafe-inline'";
        $unsafe_eval = "'unsafe-eval'";

        // Zewnętrzne usługi często używane
        $google_fonts = 'https://fonts.googleapis.com https://fonts.gstatic.com';
        $google_maps = 'https://maps.googleapis.com https://maps.gstatic.com https://*.google.com';
        $google_analytics = 'https://www.google-analytics.com https://www.googletagmanager.com https://ssl.google-analytics.com';
        $youtube = 'https://www.youtube.com https://www.youtube-nocookie.com https://i.ytimg.com';
        $facebook = 'https://www.facebook.com https://connect.facebook.net';
        $gravatar = 'https://secure.gravatar.com https://www.gravatar.com https://i0.wp.com https://i1.wp.com https://i2.wp.com';
        $cloudflare = 'https://cdnjs.cloudflare.com';
        $booking = 'https://*.booking.com https://booking.com';

        // Dyrektywy CSP
        $directives = array(
            // Domyślne źródło
            "default-src {$self}",

            // Skrypty - potrzebujemy unsafe-inline i unsafe-eval dla WordPress i Oxygen
            "script-src {$self} {$unsafe_inline} {$unsafe_eval} {$google_analytics} {$google_maps} {$youtube} {$facebook} {$cloudflare} {$booking} blob:",

            // Style - unsafe-inline potrzebne dla inline styles
            "style-src {$self} {$unsafe_inline} {$google_fonts}",

            // Obrazy
            "img-src {$self} data: blob: https: http:",

            // Czcionki
            "font-src {$self} data: {$google_fonts}",

            // Połączenia AJAX/WebSocket
            "connect-src {$self} {$google_analytics} {$google_maps} https://api.booking.com wss:",

            // Ramki (iframe)
            "frame-src {$self} {$google_maps} {$youtube} {$facebook} {$booking}",

            // Obiekty (Flash, etc.)
            "object-src 'none'",

            // Media (audio, video)
            "media-src {$self} blob: https:",

            // Formularze
            "form-action {$self}",

            // Bazowy URL
            "base-uri {$self}",

            // Przodkowie ramek (kto może nas osadzić)
            "frame-ancestors {$self}",

            // Manifest
            "manifest-src {$self}",

            // Worker
            "worker-src {$self} blob:",
        );

        // Pozwól na nadpisanie przez filtry
        $directives = apply_filters( 'hnd_security_csp_directives', $directives );

        return implode( '; ', $directives );
    }

    /**
     * Usuń wersję z query string
     */
    public function remove_version_query( $src ) {
        if ( strpos( $src, 'ver=' ) ) {
            $src = remove_query_arg( 'ver', $src );
        }
        return $src;
    }

    /**
     * Usuń X-Pingback header
     */
    public function remove_x_pingback( $headers ) {
        unset( $headers['X-Pingback'] );
        return $headers;
    }

    /**
     * Sprawdź próby logowania
     */
    public function check_login_attempts( $user, $username, $password ) {
        if ( empty( $username ) ) {
            return $user;
        }

        $ip = $this->get_client_ip();
        $lockout_key = 'hnd_login_lockout_' . md5( $ip );
        $lockout = get_transient( $lockout_key );

        if ( $lockout ) {
            $remaining = $lockout - time();
            $minutes = ceil( $remaining / 60 );

            return new WP_Error(
                'too_many_attempts',
                sprintf(
                    /* translators: %d: number of minutes */
                    __( 'Zbyt wiele nieudanych prób logowania. Spróbuj ponownie za %d minut.', 'hnd' ),
                    $minutes
                )
            );
        }

        return $user;
    }

    /**
     * Zaloguj nieudaną próbę logowania
     */
    public function log_failed_login( $username ) {
        $ip = $this->get_client_ip();
        $attempts_key = 'hnd_login_attempts_' . md5( $ip );
        $attempts = get_transient( $attempts_key );

        if ( false === $attempts ) {
            $attempts = 0;
        }

        $attempts++;

        // Ustaw transient na godzinę
        set_transient( $attempts_key, $attempts, HOUR_IN_SECONDS );

        // Sprawdź czy przekroczono limit
        if ( $attempts >= $this->settings['login_max_attempts'] ) {
            $lockout_key = 'hnd_login_lockout_' . md5( $ip );
            $lockout_time = $this->settings['login_lockout_time'] * MINUTE_IN_SECONDS;

            set_transient( $lockout_key, time() + $lockout_time, $lockout_time );

            // Loguj blokadę
            error_log( sprintf(
                'HND Security: IP %s zablokowane po %d nieudanych próbach logowania dla użytkownika: %s',
                $ip,
                $attempts,
                sanitize_text_field( $username )
            ) );

            // Wyczyść licznik prób
            delete_transient( $attempts_key );
        }
    }

    /**
     * Wyczyść próby logowania po udanym logowaniu
     */
    public function clear_login_attempts( $username, $user ) {
        $ip = $this->get_client_ip();
        $attempts_key = 'hnd_login_attempts_' . md5( $ip );
        delete_transient( $attempts_key );
    }

    /**
     * Pobierz IP klienta
     */
    private function get_client_ip() {
        $ip_keys = array(
            'HTTP_CF_CONNECTING_IP', // Cloudflare
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'REMOTE_ADDR',
        );

        foreach ( $ip_keys as $key ) {
            if ( ! empty( $_SERVER[ $key ] ) ) {
                $ip = sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) );

                // X-Forwarded-For może zawierać wiele IP
                if ( strpos( $ip, ',' ) !== false ) {
                    $ips = explode( ',', $ip );
                    $ip = trim( $ips[0] );
                }

                if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
                    return $ip;
                }
            }
        }

        return '0.0.0.0';
    }

    /**
     * Dodaj pole honeypot do komentarzy
     */
    public function add_honeypot_field() {
        echo '<p class="hnd-hp-field" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden;">';
        echo '<label for="hnd_hp_email">Email (nie wypełniaj)</label>';
        echo '<input type="text" name="hnd_hp_email" id="hnd_hp_email" value="" tabindex="-1" autocomplete="off">';
        echo '</p>';
    }

    /**
     * Sprawdź honeypot w komentarzach
     */
    public function check_honeypot( $commentdata ) {
        if ( ! empty( $_POST['hnd_hp_email'] ) ) {
            wp_die(
                __( 'Wykryto spam. Jeśli to błąd, skontaktuj się z administratorem.', 'hnd' ),
                __( 'Spam wykryty', 'hnd' ),
                array( 'response' => 403 )
            );
        }

        return $commentdata;
    }

    /**
     * Dodaj honeypot do Contact Form 7
     */
    public function add_cf7_honeypot( $form ) {
        $honeypot = '<span class="hnd-hp-cf7" style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden;">';
        $honeypot .= '<label>Zostaw puste <input type="text" name="hnd_hp_cf7" value="" tabindex="-1" autocomplete="off"></label>';
        $honeypot .= '</span>';

        // Dodaj przed ostatnim </form>
        return preg_replace( '/(<\/form>)/i', $honeypot . '$1', $form );
    }

    /**
     * Waliduj honeypot CF7
     */
    public function validate_cf7_honeypot( $result, $tags ) {
        if ( ! empty( $_POST['hnd_hp_cf7'] ) ) {
            $result->invalidate( '', __( 'Wykryto spam.', 'hnd' ) );
        }

        return $result;
    }

    /**
     * Blokuj złe boty
     */
    public function block_bad_bots() {
        if ( is_admin() ) {
            return;
        }

        $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] )
            ? strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) )
            : '';

        if ( empty( $user_agent ) ) {
            return;
        }

        // Lista znanych złych botów
        $bad_bots = array(
            'semrushbot',
            'ahrefsbot',
            'mj12bot',
            'dotbot',
            'rogerbot',
            'seznambot',
            'blexbot',
            'linkdexbot',
            'megaindex',
            'ltx71',
            'masscan',
            'python-requests',
            'go-http-client',
            'zgrab',
            'curl/',
            'wget/',
            'nikto',
            'sqlmap',
            'nmap',
            'acunetix',
            'nessus',
            'burpsuite',
            'dirbuster',
            'masscan',
        );

        // Pozwól na dodanie własnych botów przez filtr
        $bad_bots = apply_filters( 'hnd_security_bad_bots', $bad_bots );

        foreach ( $bad_bots as $bot ) {
            if ( strpos( $user_agent, $bot ) !== false ) {
                // Wyślij 403 i zakończ
                status_header( 403 );
                exit( 'Access Denied' );
            }
        }

        // Sprawdź podejrzane zapytania
        $request_uri = isset( $_SERVER['REQUEST_URI'] )
            ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) )
            : '';

        $suspicious_patterns = array(
            'wp-config',
            '.env',
            '.git',
            'phpinfo',
            'eval(',
            'base64_decode',
            '<script',
            'javascript:',
            '../..',
            '/etc/passwd',
            'proc/self',
            'wp-includes/wlwmanifest.xml',
        );

        foreach ( $suspicious_patterns as $pattern ) {
            if ( stripos( $request_uri, $pattern ) !== false ) {
                status_header( 403 );
                exit( 'Access Denied' );
            }
        }
    }

    /**
     * Bezpieczne ciasteczka
     */
    public function secure_cookies() {
        // Jeśli jesteśmy na HTTPS, ustaw secure flag dla ciasteczek
        if ( is_ssl() ) {
            @ini_set( 'session.cookie_secure', '1' );
            @ini_set( 'session.cookie_httponly', '1' );
            @ini_set( 'session.cookie_samesite', 'Strict' );
        }
    }

    /**
     * Wyłącz endpoint użytkowników REST API
     */
    public function disable_rest_users_endpoint( $endpoints ) {
        // Usuń endpoint /wp/v2/users
        if ( isset( $endpoints['/wp/v2/users'] ) ) {
            unset( $endpoints['/wp/v2/users'] );
        }

        if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
            unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
        }

        return $endpoints;
    }

    /**
     * Dodatkowe zabezpieczenia
     */
    public function additional_security() {
        // Wyłącz wyświetlanie błędów PHP na froncie
        if ( ! is_admin() && ! defined( 'WP_DEBUG' ) ) {
            @ini_set( 'display_errors', '0' );
        }

        // Zablokuj enumeration użytkowników
        if ( ! is_admin() ) {
            // Zablokuj ?author=X
            if ( isset( $_GET['author'] ) && ! empty( $_GET['author'] ) ) {
                wp_redirect( home_url(), 301 );
                exit;
            }
        }

        // Usuń informacje o wersji z RSS
        add_filter( 'the_generator', '__return_empty_string' );

        // Wyłącz pingback
        add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            unset( $methods['pingback.extensions.getPingbacks'] );
            return $methods;
        });

        // Usuń query strings z statycznych zasobów (dodatkowa ochrona cache)
        if ( ! is_admin() ) {
            add_filter( 'style_loader_src', array( $this, 'remove_version_query' ), 10 );
            add_filter( 'script_loader_src', array( $this, 'remove_version_query' ), 10 );
        }
    }

    /**
     * Wyczyść stare logi logowania
     */
    public function cleanup_login_logs() {
        global $wpdb;

        // Usuń stare transient-y związane z logowaniem
        $wpdb->query( $wpdb->prepare(
            "DELETE FROM {$wpdb->options}
             WHERE option_name LIKE %s
             AND option_value < %d",
            '_transient_hnd_login_%',
            time() - DAY_IN_SECONDS
        ) );
    }

    /**
     * Generuj .htaccess rules
     */
    public function get_htaccess_rules() {
        $rules = array();

        $rules[] = '# BEGIN HND Security Module';
        $rules[] = '';

        // Blokuj dostęp do wrażliwych plików
        $rules[] = '# Block access to sensitive files';
        $rules[] = '<FilesMatch "^(wp-config\.php|\.htaccess|\.htpasswd|readme\.html|license\.txt|xmlrpc\.php)$">';
        $rules[] = '    Order allow,deny';
        $rules[] = '    Deny from all';
        $rules[] = '</FilesMatch>';
        $rules[] = '';

        // Blokuj dostęp do ukrytych plików
        $rules[] = '# Block access to hidden files';
        $rules[] = '<FilesMatch "^\.">';
        $rules[] = '    Order allow,deny';
        $rules[] = '    Deny from all';
        $rules[] = '</FilesMatch>';
        $rules[] = '';

        // Blokuj wykonywanie PHP w uploads
        $rules[] = '# Block PHP execution in uploads';
        $rules[] = '<Directory "/wp-content/uploads/">';
        $rules[] = '    <FilesMatch "\.php$">';
        $rules[] = '        Order allow,deny';
        $rules[] = '        Deny from all';
        $rules[] = '    </FilesMatch>';
        $rules[] = '</Directory>';
        $rules[] = '';

        // Nagłówki bezpieczeństwa
        $rules[] = '# Security Headers';
        $rules[] = '<IfModule mod_headers.c>';
        $rules[] = '    Header always set X-Frame-Options "SAMEORIGIN"';
        $rules[] = '    Header always set X-Content-Type-Options "nosniff"';
        $rules[] = '    Header always set X-XSS-Protection "1; mode=block"';
        $rules[] = '    Header always set Referrer-Policy "strict-origin-when-cross-origin"';
        $rules[] = '    Header always set Permissions-Policy "geolocation=(self), microphone=(), camera=()"';
        $rules[] = '</IfModule>';
        $rules[] = '';

        // HTTPS redirect
        $rules[] = '# Force HTTPS';
        $rules[] = '<IfModule mod_rewrite.c>';
        $rules[] = '    RewriteEngine On';
        $rules[] = '    RewriteCond %{HTTPS} off';
        $rules[] = '    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]';
        $rules[] = '</IfModule>';
        $rules[] = '';

        $rules[] = '# END HND Security Module';

        return implode( "\n", $rules );
    }

    /**
     * Sprawdź status bezpieczeństwa
     */
    public function get_security_status() {
        $status = array(
            'score'    => 0,
            'max'      => 100,
            'issues'   => array(),
            'passed'   => array(),
        );

        $checks = array(
            array(
                'name'   => 'HTTPS',
                'check'  => is_ssl(),
                'points' => 20,
                'fix'    => 'Włącz certyfikat SSL i wymuszaj HTTPS',
            ),
            array(
                'name'   => 'Nagłówki bezpieczeństwa',
                'check'  => $this->settings['security_headers'],
                'points' => 15,
                'fix'    => 'Włącz nagłówki bezpieczeństwa w ustawieniach',
            ),
            array(
                'name'   => 'Content Security Policy',
                'check'  => $this->settings['csp_enabled'],
                'points' => 15,
                'fix'    => 'Włącz CSP w ustawieniach bezpieczeństwa',
            ),
            array(
                'name'   => 'Ukrycie wersji WordPress',
                'check'  => $this->settings['hide_wp_version'],
                'points' => 5,
                'fix'    => 'Włącz ukrywanie wersji WordPress',
            ),
            array(
                'name'   => 'XML-RPC wyłączone',
                'check'  => $this->settings['disable_xmlrpc'],
                'points' => 10,
                'fix'    => 'Wyłącz XML-RPC w ustawieniach',
            ),
            array(
                'name'   => 'Ochrona logowania',
                'check'  => $this->settings['login_protection'],
                'points' => 15,
                'fix'    => 'Włącz ochronę przed atakami brute-force',
            ),
            array(
                'name'   => 'Honeypot w formularzach',
                'check'  => $this->settings['honeypot_forms'],
                'points' => 5,
                'fix'    => 'Włącz ochronę honeypot dla formularzy',
            ),
            array(
                'name'   => 'Blokowanie złych botów',
                'check'  => $this->settings['block_bad_bots'],
                'points' => 10,
                'fix'    => 'Włącz blokowanie złośliwych botów',
            ),
            array(
                'name'   => 'REST API dla użytkowników wyłączone',
                'check'  => $this->settings['disable_rest_users'],
                'points' => 5,
                'fix'    => 'Wyłącz publiczny dostęp do listy użytkowników',
            ),
        );

        foreach ( $checks as $check ) {
            if ( $check['check'] ) {
                $status['score'] += $check['points'];
                $status['passed'][] = $check['name'];
            } else {
                $status['issues'][] = array(
                    'name' => $check['name'],
                    'fix'  => $check['fix'],
                );
            }
        }

        return $status;
    }

    /**
     * Aktualizuj ustawienia
     */
    public function update_settings( $new_settings ) {
        $this->settings = wp_parse_args( $new_settings, $this->settings );
        update_option( 'hnd_security_settings', $this->settings );
    }

    /**
     * Pobierz ustawienia
     */
    public function get_settings() {
        return $this->settings;
    }
}

// Inicjalizuj moduł
add_action( 'plugins_loaded', function() {
    HND_Security_Module::get_instance();
}, 5 );

// Funkcja pomocnicza
function hnd_security() {
    return HND_Security_Module::get_instance();
}
