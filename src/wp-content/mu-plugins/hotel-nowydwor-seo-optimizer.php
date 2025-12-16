<?php
/**
 * Plugin Name: PB MEDIA - Hotel Nowy Dwór SEO Optimizer
 * Description: Kompleksowa optymalizacja SEO: meta tagi, Open Graph, Twitter Cards, canonical URLs, preload hints.
 * Version: 1.0
 * Author: PB MEDIA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Główna klasa optymalizatora SEO.
 */
class Hotel_Nowydwor_SEO_Optimizer {

	/**
	 * Dane hotelu dla SEO.
	 */
	private $hotel_data = array(
		'name'        => 'Hotel Nowy Dwór',
		'tagline'     => 'Hotel w Trzebnicy koło Wrocławia',
		'description' => 'Hotel Nowy Dwór w Trzebnicy - 28 komfortowych pokoi, restauracja, sale weselne i konferencyjne. 15 km od Wrocławia. Idealne miejsce na wypoczynek, wesele i spotkania biznesowe.',
		'url'         => 'https://hotelnowydwor.eu/',
		'phone'       => '+48 71 312 07 14',
		'email'       => 'rezerwacja@hotelnowydwor.eu',
		'address'     => array(
			'street'   => 'ul. Nowy Dwór 2',
			'city'     => 'Trzebnica',
			'postcode' => '55-100',
			'country'  => 'PL',
		),
		'geo'         => array(
			'lat' => '51.3094',
			'lng' => '17.0633',
		),
		'image'       => '/wp-content/uploads/hotel-nowy-dwor-trzebnica.jpg',
		'logo'        => '/wp-content/uploads/logo-hotel-nowy-dwor.png',
	);

	/**
	 * Metadane stron - tytuły i opisy dla każdej strony.
	 */
	private $page_meta = array(
		'home'        => array(
			'title'       => 'Hotel Nowy Dwór Trzebnica | Nocleg koło Wrocławia | Restauracja',
			'description' => 'Hotel Nowy Dwór w Trzebnicy - komfortowe pokoje 15 km od Wrocławia. Restauracja, sale weselne, konferencje. Rezerwacja: +48 71 312 07 14. Sprawdź ofertę!',
		),
		'pokoje'      => array(
			'title'       => 'Pokoje hotelowe | Hotel Nowy Dwór Trzebnica | Noclegi Wrocław',
			'description' => '28 komfortowych pokoi hotelowych w Trzebnicy. Pokoje 1-2-3 osobowe, apartamenty. WiFi, TV, łazienki. Od 150 zł/noc. Rezerwuj teraz!',
		),
		'restauracja' => array(
			'title'       => 'Restauracja hotelowa | Hotel Nowy Dwór | Kuchnia polska Trzebnica',
			'description' => 'Restauracja w Hotelu Nowy Dwór - tradycyjna kuchnia polska, dania regionalne. Śniadania hotelowe, obiady, kolacje. Organizacja przyjęć i bankietów.',
		),
		'menu'        => array(
			'title'       => 'Menu restauracji | Hotel Nowy Dwór Trzebnica | Ceny i dania',
			'description' => 'Menu restauracji Hotel Nowy Dwór. Sprawdź nasze dania: zupy, dania główne, desery. Kuchnia polska, dania sezonowe. Rezerwacja stolika: +48 71 312 07 14.',
		),
		'wesela'      => array(
			'title'       => 'Wesela i przyjęcia | Sale weselne Trzebnica | Hotel Nowy Dwór',
			'description' => 'Organizacja wesel w Hotelu Nowy Dwór. Sale weselne do 150 osób, catering, noclegi dla gości. Kompleksowa obsługa wesela koło Wrocławia.',
		),
		'konferencje' => array(
			'title'       => 'Sale konferencyjne Trzebnica | Hotel Nowy Dwór | Szkolenia',
			'description' => 'Sale konferencyjne i szkoleniowe w Hotelu Nowy Dwór. Wyposażenie multimedialne, catering, noclegi. Organizacja eventów firmowych koło Wrocławia.',
		),
		'galeria'     => array(
			'title'       => 'Galeria zdjęć | Hotel Nowy Dwór Trzebnica | Wnętrza i otoczenie',
			'description' => 'Zdjęcia Hotelu Nowy Dwór w Trzebnicy. Zobacz pokoje, restaurację, sale weselne, otoczenie. Wirtualny spacer po hotelu koło Wrocławia.',
		),
		'kontakt'     => array(
			'title'       => 'Kontakt | Hotel Nowy Dwór Trzebnica | Rezerwacja pokoi',
			'description' => 'Kontakt z Hotelem Nowy Dwór: +48 71 312 07 14, rezerwacja@hotelnowydwor.eu. Adres: ul. Nowy Dwór 2, 55-100 Trzebnica. Dojazd, mapa, godziny otwarcia.',
		),
		'o-nas'       => array(
			'title'       => 'O nas | Historia Hotelu Nowy Dwór | Hotel Trzebnica',
			'description' => 'Historia Hotelu Nowy Dwór w Trzebnicy. Poznaj nasz zespół, standardy obsługi i filozofię gościnności. Hotel z tradycją koło Wrocławia.',
		),
		'faq'         => array(
			'title'       => 'FAQ - Pytania i odpowiedzi | Hotel Nowy Dwór Trzebnica',
			'description' => 'Często zadawane pytania o Hotel Nowy Dwór. Informacje o rezerwacji, check-in, płatnościach, udogodnieniach. Wszystko co musisz wiedzieć przed przyjazdem.',
		),
		'regulamin'   => array(
			'title'       => 'Regulamin hotelowy | Hotel Nowy Dwór Trzebnica',
			'description' => 'Regulamin pobytu w Hotelu Nowy Dwór. Zasady rezerwacji, anulowania, check-in/check-out, zwierzęta, cisza nocna. Przeczytaj przed przyjazdem.',
		),
		'cennik'      => array(
			'title'       => 'Cennik pokoi | Hotel Nowy Dwór Trzebnica | Ceny noclegów',
			'description' => 'Cennik pokoi hotelowych Hotel Nowy Dwór. Aktualne ceny noclegów, promocje sezonowe, pakiety pobytowe. Od 150 zł za noc. Rezerwuj online!',
		),
	);

	/**
	 * Konstruktor - rejestruje hooki.
	 */
	public function __construct() {
		// Meta tagi w <head>.
		add_action( 'wp_head', array( $this, 'output_meta_tags' ), 1 );

		// Canonical URL.
		add_action( 'wp_head', array( $this, 'output_canonical' ), 2 );

		// Open Graph.
		add_action( 'wp_head', array( $this, 'output_open_graph' ), 3 );

		// Twitter Cards.
		add_action( 'wp_head', array( $this, 'output_twitter_cards' ), 4 );

		// Preload hints.
		add_action( 'wp_head', array( $this, 'output_preload_hints' ), 5 );

		// DNS prefetch.
		add_action( 'wp_head', array( $this, 'output_dns_prefetch' ), 6 );

		// Hreflang dla Polski.
		add_action( 'wp_head', array( $this, 'output_hreflang' ), 7 );

		// Filtruj domyślny tytuł WordPress.
		add_filter( 'pre_get_document_title', array( $this, 'custom_document_title' ), 10 );
		add_filter( 'document_title_parts', array( $this, 'filter_title_parts' ), 10 );

		// Usuń domyślne canonical z WordPress (jeśli dodajemy własne).
		remove_action( 'wp_head', 'rel_canonical' );
	}

	/**
	 * Pobierz slug aktualnej strony.
	 */
	private function get_current_page_slug() {
		if ( is_front_page() || is_home() ) {
			return 'home';
		}

		if ( is_page() ) {
			$slug = get_post_field( 'post_name', get_queried_object_id() );
			return $slug;
		}

		if ( is_singular() ) {
			return get_post_field( 'post_name', get_queried_object_id() );
		}

		return '';
	}

	/**
	 * Pobierz metadane dla aktualnej strony.
	 */
	private function get_page_meta() {
		$slug = $this->get_current_page_slug();

		if ( isset( $this->page_meta[ $slug ] ) ) {
			return $this->page_meta[ $slug ];
		}

		// Fallback dla stron bez zdefiniowanych metadanych.
		$title = '';
		$description = '';

		if ( is_singular() ) {
			$post = get_queried_object();
			$title = get_the_title() . ' | ' . $this->hotel_data['name'];

			// Użyj excerpt jako opisu lub wygeneruj z treści.
			$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( strip_tags( $post->post_content ), 25 );
		} elseif ( is_archive() ) {
			$title = get_the_archive_title() . ' | ' . $this->hotel_data['name'];
			$description = get_the_archive_description() ?: $this->hotel_data['description'];
		} elseif ( is_search() ) {
			$title = 'Wyniki wyszukiwania: ' . get_search_query() . ' | ' . $this->hotel_data['name'];
			$description = 'Wyniki wyszukiwania dla zapytania: ' . get_search_query();
		} elseif ( is_404() ) {
			$title = 'Strona nie znaleziona | ' . $this->hotel_data['name'];
			$description = 'Przepraszamy, strona której szukasz nie istnieje. Wróć na stronę główną Hotelu Nowy Dwór.';
		}

		return array(
			'title'       => $title ?: $this->hotel_data['name'] . ' | ' . $this->hotel_data['tagline'],
			'description' => $description ?: $this->hotel_data['description'],
		);
	}

	/**
	 * Customowy tytuł dokumentu.
	 */
	public function custom_document_title( $title ) {
		$meta = $this->get_page_meta();
		return $meta['title'] ?: $title;
	}

	/**
	 * Filtruj części tytułu.
	 */
	public function filter_title_parts( $title_parts ) {
		$meta = $this->get_page_meta();

		if ( ! empty( $meta['title'] ) ) {
			// Zwróć tylko nasz customowy tytuł.
			return array( 'title' => $meta['title'] );
		}

		return $title_parts;
	}

	/**
	 * Wyjście meta tagów.
	 */
	public function output_meta_tags() {
		$meta = $this->get_page_meta();

		echo "\n<!-- Hotel Nowy Dwór SEO Optimizer -->\n";

		// Meta description.
		if ( ! empty( $meta['description'] ) ) {
			echo '<meta name="description" content="' . esc_attr( $meta['description'] ) . '">' . "\n";
		}

		// Meta keywords (opcjonalnie - mniejsze znaczenie w SEO).
		$keywords = $this->get_page_keywords();
		if ( ! empty( $keywords ) ) {
			echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '">' . "\n";
		}

		// Author.
		echo '<meta name="author" content="' . esc_attr( $this->hotel_data['name'] ) . '">' . "\n";

		// Robots.
		if ( is_search() || is_404() ) {
			echo '<meta name="robots" content="noindex, follow">' . "\n";
		} else {
			echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
		}

		// Geo tags.
		echo '<meta name="geo.region" content="PL-DS">' . "\n";
		echo '<meta name="geo.placename" content="Trzebnica">' . "\n";
		echo '<meta name="geo.position" content="' . esc_attr( $this->hotel_data['geo']['lat'] ) . ';' . esc_attr( $this->hotel_data['geo']['lng'] ) . '">' . "\n";
		echo '<meta name="ICBM" content="' . esc_attr( $this->hotel_data['geo']['lat'] ) . ', ' . esc_attr( $this->hotel_data['geo']['lng'] ) . '">' . "\n";
	}

	/**
	 * Pobierz słowa kluczowe dla strony.
	 */
	private function get_page_keywords() {
		$slug = $this->get_current_page_slug();

		$keywords_map = array(
			'home'        => 'hotel trzebnica, nocleg wrocław, hotel nowy dwór, hotel koło wrocławia, noclegi trzebnica, hotel dolny śląsk',
			'pokoje'      => 'pokoje hotelowe trzebnica, noclegi wrocław, pokój hotelowy, apartament hotel, hotel nowy dwór pokoje',
			'restauracja' => 'restauracja trzebnica, kuchnia polska, restauracja hotelowa, jedzenie trzebnica, restauracja wrocław',
			'wesela'      => 'wesele trzebnica, sala weselna wrocław, organizacja wesela, hotel na wesele, wesele dolny śląsk',
			'konferencje' => 'sala konferencyjna trzebnica, szkolenia wrocław, konferencje hotel, eventy firmowe, hotel konferencyjny',
			'kontakt'     => 'kontakt hotel trzebnica, rezerwacja pokoi, adres hotel nowy dwór, telefon hotel',
			'faq'         => 'hotel trzebnica pytania, faq hotel, informacje hotel nowy dwór',
		);

		return isset( $keywords_map[ $slug ] ) ? $keywords_map[ $slug ] : 'hotel trzebnica, hotel nowy dwór, noclegi wrocław';
	}

	/**
	 * Wyjście canonical URL.
	 */
	public function output_canonical() {
		$canonical = $this->get_canonical_url();

		if ( $canonical ) {
			echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
		}
	}

	/**
	 * Pobierz canonical URL.
	 */
	private function get_canonical_url() {
		if ( is_front_page() ) {
			return home_url( '/' );
		}

		if ( is_singular() ) {
			return get_permalink();
		}

		if ( is_archive() ) {
			if ( is_category() ) {
				return get_category_link( get_queried_object_id() );
			}
			if ( is_tag() ) {
				return get_tag_link( get_queried_object_id() );
			}
			if ( is_post_type_archive() ) {
				return get_post_type_archive_link( get_post_type() );
			}
		}

		return '';
	}

	/**
	 * Wyjście Open Graph tags.
	 */
	public function output_open_graph() {
		$meta  = $this->get_page_meta();
		$image = $this->get_og_image();

		echo "\n<!-- Open Graph -->\n";
		echo '<meta property="og:locale" content="pl_PL">' . "\n";
		echo '<meta property="og:type" content="' . esc_attr( $this->get_og_type() ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $meta['title'] ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $meta['description'] ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $this->get_canonical_url() ?: home_url( $_SERVER['REQUEST_URI'] ) ) . '">' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( $this->hotel_data['name'] ) . '">' . "\n";

		if ( $image ) {
			echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
			echo '<meta property="og:image:width" content="1200">' . "\n";
			echo '<meta property="og:image:height" content="630">' . "\n";
			echo '<meta property="og:image:alt" content="' . esc_attr( $this->hotel_data['name'] ) . '">' . "\n";
		}

		// Dane kontaktowe dla business.
		echo '<meta property="business:contact_data:street_address" content="' . esc_attr( $this->hotel_data['address']['street'] ) . '">' . "\n";
		echo '<meta property="business:contact_data:locality" content="' . esc_attr( $this->hotel_data['address']['city'] ) . '">' . "\n";
		echo '<meta property="business:contact_data:postal_code" content="' . esc_attr( $this->hotel_data['address']['postcode'] ) . '">' . "\n";
		echo '<meta property="business:contact_data:country_name" content="Polska">' . "\n";
		echo '<meta property="business:contact_data:email" content="' . esc_attr( $this->hotel_data['email'] ) . '">' . "\n";
		echo '<meta property="business:contact_data:phone_number" content="' . esc_attr( $this->hotel_data['phone'] ) . '">' . "\n";

		// Dodatkowe tagi Place.
		echo '<meta property="place:location:latitude" content="' . esc_attr( $this->hotel_data['geo']['lat'] ) . '">' . "\n";
		echo '<meta property="place:location:longitude" content="' . esc_attr( $this->hotel_data['geo']['lng'] ) . '">' . "\n";
	}

	/**
	 * Pobierz typ Open Graph.
	 */
	private function get_og_type() {
		if ( is_front_page() ) {
			return 'website';
		}

		$slug = $this->get_current_page_slug();

		// Strony związane z miejscem.
		if ( in_array( $slug, array( 'kontakt', 'o-nas', 'pokoje', 'restauracja' ), true ) ) {
			return 'place';
		}

		if ( is_singular( 'post' ) ) {
			return 'article';
		}

		return 'website';
	}

	/**
	 * Pobierz obrazek Open Graph.
	 */
	private function get_og_image() {
		// Najpierw sprawdź featured image.
		if ( is_singular() && has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			if ( $image ) {
				return $image[0];
			}
		}

		// Fallback na obrazek hotelu.
		$default_image = home_url( $this->hotel_data['image'] );

		// Sprawdź czy plik istnieje.
		$image_path = ABSPATH . ltrim( $this->hotel_data['image'], '/' );
		if ( file_exists( $image_path ) ) {
			return $default_image;
		}

		// Ostateczny fallback - logo.
		return home_url( $this->hotel_data['logo'] );
	}

	/**
	 * Wyjście Twitter Cards.
	 */
	public function output_twitter_cards() {
		$meta  = $this->get_page_meta();
		$image = $this->get_og_image();

		echo "\n<!-- Twitter Cards -->\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $meta['title'] ) . '">' . "\n";
		echo '<meta name="twitter:description" content="' . esc_attr( $meta['description'] ) . '">' . "\n";

		if ( $image ) {
			echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
			echo '<meta name="twitter:image:alt" content="' . esc_attr( $this->hotel_data['name'] ) . '">' . "\n";
		}
	}

	/**
	 * Wyjście preload hints dla krytycznych zasobów.
	 */
	public function output_preload_hints() {
		echo "\n<!-- Preload Hints -->\n";

		// Preload czcionek (jeśli używane).
		// echo '<link rel="preload" href="/wp-content/themes/your-theme/fonts/font.woff2" as="font" type="font/woff2" crossorigin>' . "\n";

		// Preload krytycznego CSS (jeśli jest).
		echo '<link rel="preload" href="/hotelnowydwor.eu-new/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=6.1.4" as="style">' . "\n";
		echo '<link rel="preload" href="/hotelnowydwor.eu-new/wp-includes/css/admin-bar.min.css" as="style">' . "\n";
		echo '<link rel="preload" href="/hotelnowydwor.eu-new/wp-content/plugins/insert-headers-and-footers/build/admin-bar.css?ver=c95624a69c80301272a0" as="style">' . "\n";
		echo '<link rel="preload" href="/hotelnowydwor.eu-new/wp-includes/css/dashicons.min.css" as="style">' . "\n";
		echo '<link rel="preload" href="/hotelnowydwor.eu-new/wp-content/plugins/oxygen/component-framework/oxygen.css?ver=4.9.3" as="style">' . "\n";
		echo '<link rel="preload" href="/hotelnowydwor.eu-new/wp-content/plugins/oxygen/component-framework/vendor/aos/aos.css" as="style">' . "\n";
		echo '<link rel="preload" href="/hotelnowydwor.eu-new/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=6.1.4" as="style">' . "\n";

		// Preload LCP image na stronie głównej.
		if ( is_front_page() ) {
			$hero_image = home_url( '/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.jpg' );
			echo '<link rel="preload" as="image" href="' . esc_url( $hero_image ) . '" fetchpriority="high">' . "\n";
		}
	}

	/**
	 * Wyjście DNS prefetch dla zewnętrznych zasobów.
	 */
	public function output_dns_prefetch() {
		echo "\n<!-- DNS Prefetch & Preconnect -->\n";

		$domains = array(
			'https://fonts.googleapis.com',
			'https://fonts.gstatic.com',
			'https://www.google-analytics.com',
			'https://www.googletagmanager.com',
			'https://maps.googleapis.com',
			'https://nfhotel.pl/',
			'https://nowydwor.smarthost.pl',
			'https://hotelnowydwor.eu',
		);

		foreach ( $domains as $domain ) {
			echo '<link rel="dns-prefetch" href="' . esc_url( $domain ) . '">' . "\n";
			echo '<link rel="preconnect" href="' . esc_url( $domain ) . '" crossorigin>' . "\n";
		}
	}

	/**
	 * Wyjście hreflang tags.
	 */
	public function output_hreflang() {
		$canonical = $this->get_canonical_url() ?: home_url( $_SERVER['REQUEST_URI'] );

		echo "\n<!-- Hreflang -->\n";
		echo '<link rel="alternate" hreflang="pl" href="' . esc_url( $canonical ) . '">' . "\n";
		echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $canonical ) . '">' . "\n";
	}
}

// Inicjalizacja.
new Hotel_Nowydwor_SEO_Optimizer();

/**
 * Dodaj wsparcie dla theme-color (mobile browsers).
 */
add_action( 'wp_head', 'hotel_nowydwor_theme_color', 0 );
function hotel_nowydwor_theme_color() {
	echo '<meta name="theme-color" content="#0a97b0">' . "\n";
	echo '<meta name="msapplication-TileColor" content="#0a97b0">' . "\n";
}

/**
 * Dodaj viewport meta tag (jeśli brak w motywie).
 */
add_action( 'wp_head', 'hotel_nowydwor_viewport', 0 );
function hotel_nowydwor_viewport() {
	// Sprawdź czy viewport już istnieje.
	if ( ! has_action( 'wp_head', '_wp_render_title_tag' ) ) {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">' . "\n";
	}
}

/**
 * Optymalizuj output title tag.
 */
add_theme_support( 'title-tag' );
