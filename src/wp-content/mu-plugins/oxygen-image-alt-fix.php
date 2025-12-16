<?php
/**
 * Plugin Name: Oxygen Builder Image Alt Fix
 * Description: Automatycznie dodaje atrybut ALT do obrazów w Oxygen Builder na podstawie danych z Biblioteki Mediów.
 * Version: 1.0
 * Author: PB MEDIA SEO Agent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Blokada bezpośredniego dostępu
}

/**
 * Funkcja wymuszająca dodanie atrybutu alt do tagów <img> generowanych przez Oxygen
 * Działa na buforze wyjściowym strony.
 */
function pbmedia_add_missing_alt_tags_buffer_start() {
    // Nie uruchamiaj w panelu admina ani dla żądań AJAX/REST/Cron
    if ( is_admin() || wp_doing_ajax() || defined( 'REST_REQUEST' ) || defined( 'DOING_CRON' ) ) {
        return;
    }
    
    // Rozpocznij buforowanie wyjścia
    ob_start( 'pbmedia_process_html_for_alts' );
}
add_action( 'template_redirect', 'pbmedia_add_missing_alt_tags_buffer_start' );

/**
 * Przetwarza kod HTML strony i uzupełnia brakujące alty
 */
function pbmedia_process_html_for_alts( $content ) {
    // Jeśli treść jest pusta, zwróć bez zmian
    if ( empty( $content ) ) {
        return $content;
    }

    // Używamy DOMDocument do parsowania HTML (jest bardziej precyzyjny niż Regex)
    $dom = new DOMDocument();
    
    // Wyłączanie błędów parsowania dla nieprawidłowego HTML (typowe dla nowoczesnych stron HTML5)
    libxml_use_internal_errors( true );
    
    // Ładowanie HTML z kodowaniem UTF-8 hack
    // mb_convert_encoding jest używane, aby DOMDocument poprawnie obsłużył polskie znaki
    $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
    
    libxml_clear_errors();

    // Znajdź wszystkie obrazki
    $images = $dom->getElementsByTagName( 'img' );
    $modified = false;

    foreach ( $images as $img ) {
        // Sprawdź czy obrazek ma już atrybut alt i czy nie jest pusty
        // Jeśli alt istnieje i ma treść - pomijamy (szanujemy ręczne ustawienia)
        if ( $img->hasAttribute( 'alt' ) && strlen( trim( $img->getAttribute( 'alt' ) ) ) > 0 ) {
            continue;
        }

        // Pobierz URL obrazka
        $src = $img->getAttribute( 'src' );
        
        // Próba uzyskania ID obrazka z adresu URL
        $attachment_id = pbmedia_get_attachment_id_by_url( $src );

        if ( $attachment_id ) {
            // Pobierz tekst alternatywny z biblioteki mediów
            $alt_text = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

            // Jeśli znaleziono alt w bibliotece, dodaj go do tagu img
            if ( ! empty( $alt_text ) ) {
                $img->setAttribute( 'alt', $alt_text );
                $modified = true;
            } else {
                // Opcjonalnie: Jeśli w bibliotece też nie ma alta, dodaj pusty alt="" (wymóg WCAG dla elementów dekoracyjnych)
                // lub wygeneruj go z nazwy pliku (odkomentuj poniższą linię jeśli chcesz)
                // $img->setAttribute( 'alt', get_the_title( $attachment_id ) );
            }
        }
    }

    // Jeśli dokonano zmian, zwróć zmodyfikowany HTML
    if ( $modified ) {
        return $dom->saveHTML();
    }

    return $content;
}

/**
 * Pomocnicza funkcja do znajdowania ID załącznika na podstawie URL
 */
function pbmedia_get_attachment_id_by_url( $url ) {
    // Usunięcie parametrów zapytania (np. wersji ?v=1)
    $url = strtok( $url, '?' );
    
    // Globalna baza danych WP
    global $wpdb;
    
    // Próba znalezienia ID w bazie danych
    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url ) ); 
    
    if ( ! empty( $attachment ) ) {
        return $attachment[0]; 
    }
    
    // Jeśli nie znaleziono po pełnym URL, spróbuj po ścieżce relatywnej (częsty przypadek w WP)
    $upload_dir_paths = wp_upload_dir();
    
    // Jeśli URL zawiera domenę, wytnij ją, aby szukać po ścieżce
    if ( strpos( $url, $upload_dir_paths['baseurl'] ) !== false ) {
        $url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $url );
        
        // Szukamy w meta danych 'attached_file'
        $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_attached_file' AND meta_value='%s';", $url ) );
        
        if ( ! empty( $attachment ) ) {
            return $attachment[0];
        }
    }

    return 0;
}