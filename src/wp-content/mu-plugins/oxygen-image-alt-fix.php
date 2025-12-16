<?php
/**
 * Plugin Name: PB MEDIA - Oxygen Builder Image Alt Fix
 * Description:  Automatycznie dodaje atrybut ALT do obrazów w Oxygen Builder na podstawie danych z Biblioteki Mediów. 
 * Version: 1.1.0
 * Author: PB MEDIA SEO Agent
 * Text Domain: pb-image-alt
 */

// Zabezpieczenie przed bezpośrednim dostępem
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Rozpoczyna buforowanie wyjścia na frontendzie. 
 * Wymusza dodanie atrybutu alt do tagów <img> generowanych przez Oxygen. 
 *
 * @since 1.0.0
 * @return void
 */
function pbmedia_add_missing_alt_tags_buffer_start() {
    // Nie uruchamiaj w panelu admina, dla żądań AJAX/REST/Cron ani w edytorze Oxygen
    if ( is_admin() || wp_doing_ajax() || defined( 'REST_REQUEST' ) || defined( 'DOING_CRON' ) ) {
        return;
    }

    // Nie uruchamiaj w edytorze Oxygen Builder
    if ( defined( 'SHOW_CT_BUILDER' ) ) {
        return;
    }

    // Rozpocznij buforowanie wyjścia
    ob_start( 'pbmedia_process_html_for_alts' );
}
add_action( 'template_redirect', 'pbmedia_add_missing_alt_tags_buffer_start' );

/**
 * Przetwarza kod HTML strony i uzupełnia brakujące atrybuty alt.
 *
 * @since 1.0.0
 * @param string $content Zawartość bufora HTML. 
 * @return string Zmodyfikowana zawartość HTML.
 */
function pbmedia_process_html_for_alts( $content ) {
    // Jeśli treść jest pusta, zwróć bez zmian
    if ( empty( $content ) ) {
        return $content;
    }

    // Używamy DOMDocument do parsowania HTML
    $dom = new DOMDocument();

    // Wyłączanie błędów parsowania dla nieprawidłowego HTML (typowe dla HTML5)
    libxml_use_internal_errors( true );

    /**
     * NAPRAWA BŁĘDU PHP 8.2+: 
     * Zamiast przestarzałego mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8')
     * używamy deklaracji kodowania UTF-8 bezpośrednio w dokumencie XML.
     *
     * Metoda:  Dodajemy meta tag charset przed zawartością HTML,
     * aby DOMDocument poprawnie interpretował polskie znaki.
     */
    $content_with_charset = '<?xml encoding="UTF-8">' . $content;

    // Ładowanie HTML z flagami zapobiegającymi dodawaniu DOCTYPE i wrapper elementów
    $dom->loadHTML(
        $content_with_charset,
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING
    );

    libxml_clear_errors();

    // Znajdź wszystkie obrazki
    $images   = $dom->getElementsByTagName( 'img' );
    $modified = false;

    foreach ( $images as $img ) {
        // Sprawdź czy obrazek ma już atrybut alt i czy nie jest pusty
        // Jeśli alt istnieje i ma treść - pomijamy (szanujemy ręczne ustawienia)
        if ( $img->hasAttribute( 'alt' ) && strlen( trim( $img->getAttribute( 'alt' ) ) ) > 0 ) {
            continue;
        }

        // Pobierz URL obrazka (sprawdź src i data-src dla lazy loading)
        $src = $img->getAttribute( 'src' );
        if ( empty( $src ) || strpos( $src, 'data:' ) === 0 ) {
            $src = $img->getAttribute( 'data-src' );
        }

        if ( empty( $src ) ) {
            continue;
        }

        // Próba uzyskania ID obrazka z adresu URL
        $attachment_id = pbmedia_get_attachment_id_by_url( $src );

        if ( $attachment_id ) {
            // Pobierz tekst alternatywny z biblioteki mediów
            $alt_text = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

            // Jeśli znaleziono alt w bibliotece, dodaj go do tagu img
            if ( ! empty( $alt_text ) ) {
                $img->setAttribute( 'alt', esc_attr( $alt_text ) );
                $modified = true;
            } else {
                // Fallback:  użyj tytułu załącznika jeśli brak alt
                $attachment_title = get_the_title( $attachment_id );
                if ( ! empty( $attachment_title ) ) {
                    $img->setAttribute( 'alt', esc_attr( $attachment_title ) );
                    $modified = true;
                }
            }
        }
    }

    // Jeśli dokonano zmian, zwróć zmodyfikowany HTML
    if ( $modified ) {
        $output = $dom->saveHTML();

        // Usuń dodaną deklarację XML encoding z początku
        $output = preg_replace( '/^<\?xml encoding="UTF-8"\?>\s*/i', '', $output );

        return $output;
    }

    return $content;
}

/**
 * Pomocnicza funkcja do znajdowania ID załącznika na podstawie URL.
 * Obsługuje różne formaty URL (pełne, relatywne, stare domeny).
 *
 * @since 1.0.0
 * @param string $url URL obrazka.
 * @return int ID załącznika lub 0 jeśli nie znaleziono.
 */
function pbmedia_get_attachment_id_by_url( $url ) {
    // Usunięcie parametrów zapytania (np. wersji ? v=1)
    $url = strtok( $url, '?' );

    // Próba standardowej funkcji WordPress
    $attachment_id = attachment_url_to_postid( $url );

    if ( $attachment_id ) {
        return $attachment_id;
    }

    // Obsługa starej domeny (nfhotel.usermd.net -> hotelnowydwor.eu)
    $site_url    = get_site_url();
    $site_domain = wp_parse_url( $site_url, PHP_URL_HOST );
    $img_domain  = wp_parse_url( $url, PHP_URL_HOST );

    if ( $img_domain && $img_domain !== $site_domain ) {
        // Podmień domenę obrazka na domenę strony
        $fixed_url = str_replace( $img_domain, $site_domain, $url );
        $fixed_url = str_replace( 'http://', 'https://', $fixed_url );

        $attachment_id = attachment_url_to_postid( $fixed_url );

        if ( $attachment_id ) {
            return $attachment_id;
        }
    }

    // Ostateczna próba:  szukanie po nazwie pliku w bazie danych
    global $wpdb;

    $filename = basename( $url );

    // Usuń wymiary z nazwy pliku (np. image-300x200.jpg -> image. jpg)
    $filename_without_size = preg_replace( '/-\d+x\d+(? =\.[a-z]{3,4}$)/i', '', $filename );

    // Szukaj w meta danych '_wp_attached_file'
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery. DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
    $attachment_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta}
             WHERE meta_key = '_wp_attached_file'
             AND (meta_value LIKE %s OR meta_value LIKE %s)
             LIMIT 1",
            '%' . $wpdb->esc_like( $filename ) . '%',
            '%' .  $wpdb->esc_like( $filename_without_size ) . '%'
        )
    );

    return $attachment_id ?  (int) $attachment_id : 0;
}