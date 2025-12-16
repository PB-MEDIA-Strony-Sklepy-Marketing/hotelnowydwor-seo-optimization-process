<?php
/**
 * Plugin Name: PB MEDIA - Oxygen Alt Attribute Fixer
 * Description: Automatycznie uzupełnia brakujące atrybuty ALT w obrazach generowanych przez Oxygen Builder i OxyExtras. Obsługuje migrację domen.
 * Version: 1.2
 * Author: PB MEDIA
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Uruchom buforowanie wyjścia tylko na froncie strony.
 */
function pb_media_buffer_start() {
    // Nie uruchamiaj w panelu admina, dla feedów XML, API REST itp.
    if (is_admin() || is_feed() || defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }
    
    // Rozpocznij buforowanie z funkcją callback
    ob_start('pb_media_add_alt_tags_callback');
}
add_action('template_redirect', 'pb_media_buffer_start', 1);

/**
 * Główna funkcja przetwarzająca kod HTML strony.
 */
function pb_media_add_alt_tags_callback($content) {
    // Napraw wyciek kodu jQuery z Oxygen Pro Menu.
    // Problem: niezamknięte tagi script powodują wyświetlanie kodu jQuery jako tekst.
    $content = pb_media_fix_jquery_leak($content);

    // Znajdź wszystkie tagi <img>
    // Regex szuka tagów img, które mogą mieć różne atrybuty
    $pattern = '/<img([^>]+)>/i';

    return preg_replace_callback($pattern, 'pb_media_process_img_tag', $content);
}

/**
 * Naprawia wyciek kodu jQuery z Oxygen Pro Menu.
 * Usuwa orphaned jQuery code wyświetlany jako tekst na stronie.
 */
function pb_media_fix_jquery_leak($content) {
    // Wzorzec: wyciek kodu jQuery z Pro Menu (bez zamknięcia tagu script).
    // Przykład: '); }); jQuery('#-pro-menu-134-11 .oxy-pro-menu-show-dropdown...
    $patterns = array(
        // Usuń wyciek kodu jQuery z Pro Menu wyświetlany jako tekst (pełny wzorzec).
        '/\'\);\s*\}\);\s*jQuery\([\'"][^"\']+[\'"][^\)]*\)\.[^;]+;/s',
        // Usuń krótszy wyciek: '); });
        '/\'\);\s*\}\);/s',
        // Usuń samo }); na końcu linii (orphaned).
        '/(?<=[>\s])\}\);(?=\s*<)/s',
    );

    foreach ($patterns as $pattern) {
        $content = preg_replace($pattern, '', $content);
    }

    return $content;
}

/**
 * Funkcja przetwarzająca pojedynczy tag <img>
 */
function pb_media_process_img_tag($matches) {
    $full_tag = $matches[0];
    $attributes_str = $matches[1];

    // 1. Wyciągnij SRC
    if (!preg_match('/src=["\']([^"\']+)["\']/i', $attributes_str, $src_match)) {
        return $full_tag; // Brak src, zwracamy bez zmian
    }
    $src = $src_match[1];

    // 2. Wyciągnij obecny ALT (jeśli istnieje)
    $has_alt = preg_match('/alt=["\']([^"\']*)["\']/i', $attributes_str, $alt_match);
    $current_alt_value = $has_alt ? trim($alt_match[1]) : null;

    // JEŚLI atrybut alt istnieje i NIE JEST PUSTY -> zostawiamy go w spokoju (priorytet ręcznego wpisania w Oxygen)
    if ($has_alt && !empty($current_alt_value)) {
        return $full_tag;
    }

    // 3. Pobierz tekst alternatywny z bazy danych na podstawie SRC
    $alt_text = pb_media_get_alt_from_url($src);

    // Jeśli nie udało się znaleźć tekstu w bazie, a alt jest pusty, 
    // możemy opcjonalnie wygenerować go z nazwy pliku (odkomentuj poniższą linię, jeśli chcesz)
    // if (!$alt_text) { $alt_text = pb_media_generate_alt_from_filename($src); }

    if (!$alt_text) {
        // Jeśli nadal brak tekstu, a tag nie miał atrybutu alt, dodaj pusty alt dla walidacji W3C
        if (!$has_alt) {
            return str_replace('<img', '<img alt=""', $full_tag);
        }
        return $full_tag;
    }

    // 4. Podmień lub dodaj atrybut ALT
    $safe_alt = esc_attr($alt_text);

    if ($has_alt) {
        // Podmień pusty alt="" na alt="treść"
        // Używamy precyzyjnego regexa, żeby nie podmienić czegoś innego
        return preg_replace('/alt=["\']["\']/', 'alt="' . $safe_alt . '"', $full_tag, 1);
    } else {
        // Dodaj atrybut alt na końcu tagu (przed zamknięciem)
        // Usuwamy ewentualny slash na końcu dla xhtml
        $clean_tag = rtrim($full_tag, ' />>'); 
        return $clean_tag . ' alt="' . $safe_alt . '"' . (strpos($full_tag, '/>') !== false ? ' />' : '>');
    }
}

/**
 * Pomocnicza: Pobiera ID obrazka i ALT na podstawie URL (z obsługą cache i starych domen)
 */
function pb_media_get_alt_from_url($image_url) {
    global $wpdb;

    // Normalizacja URL - usuwamy query strings (np. ?v=1.0)
    $image_url = strtok($image_url, '?');

    // CACHE: Sprawdź czy mamy to już w pamięci podręcznej (Transient)
    // Klucz cache to hash MD5 z URL, żeby był krótki
    $cache_key = 'img_alt_' . md5($image_url);
    $cached_alt = get_transient($cache_key);
    
    if ($cached_alt !== false) {
        return $cached_alt;
    }

    // 1. Próba standardowa WordPressa
    $attachment_id = attachment_url_to_postid($image_url);

    // 2. Próba naprawcza dla starej domeny (nfhotel.usermd.net -> hotelnowydwor.eu)
    if (!$attachment_id) {
        $site_url = get_site_url(); // np. https://www.hotelnowydwor.eu
        $site_domain = parse_url($site_url, PHP_URL_HOST);
        
        $img_domain = parse_url($image_url, PHP_URL_HOST);

        // Jeśli domena obrazka jest inna niż strony (np. stara domena)
        if ($img_domain && $img_domain !== $site_domain) {
            // Podmień domenę obrazka na domenę strony i spróbuj ponownie
            $fixed_url = str_replace($img_domain, $site_domain, $image_url);
            // Upewnij się też o protokole
            $fixed_url = str_replace('http://', 'https://', $fixed_url);
            
            $attachment_id = attachment_url_to_postid($fixed_url);
        }
    }

    // 3. Ostateczna próba: Szukanie po samej nazwie pliku w bazie (SQL) - ostateczność
    if (!$attachment_id) {
        $filename = basename($image_url);
        // Szukaj w tabeli postmeta (gdzie przechowywane są ścieżki plików)
        $sql = $wpdb->prepare(
            "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s LIMIT 1",
            '%' . $wpdb->esc_like($filename)
        );
        $attachment_id = $wpdb->get_var($sql);
    }

    $alt_text = '';

    if ($attachment_id) {
        // Pobierz tekst alternatywny z meta danych
        $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        
        // Fallback: Jeśli brak ALT, weź Tytuł obrazka
        if (!$alt_text) {
            $alt_text = get_the_title($attachment_id);
        }
    }

    // Zapisz w cache na 24 godziny (86400 sekund)
    set_transient($cache_key, (string)$alt_text, 86400);

    return $alt_text;
}

/**
 * Opcjonalna: Generuj ALT z nazwy pliku (gdy brak w bazie)
 * Np. "pokoj-lux-trzebnica.jpg" -> "Pokoj lux trzebnica"
 */
function pb_media_generate_alt_from_filename($url) {
    $filename = pathinfo($url, PATHINFO_FILENAME);
    $filename = preg_replace('/[-_]/', ' ', $filename); // Zamień myślniki na spacje
    $filename = preg_replace('/\d+x\d+$/', '', $filename); // Usuń wymiary np 300x300
    return ucfirst(trim($filename));
}