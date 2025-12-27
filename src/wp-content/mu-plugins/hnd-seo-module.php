<?php
/**
 * HND SEO Module
 *
 * Moduł optymalizacji SEO dla Hotel Nowy Dwór.
 * Implementuje meta tagi, Schema.org, Open Graph, Twitter Cards.
 *
 * @package     HND_PageSpeed_Optimizer
 * @subpackage  SEO_Module
 * @version     1.0.0
 * @author      Hotel Nowy Dwór
 *
 * INSTRUKCJA DLA POCZĄTKUJĄCYCH:
 * =============================
 * Ten plik automatycznie poprawia SEO strony:
 *
 * 1. META TAGI - Optymalne title i description dla każdej strony
 * 2. SCHEMA.ORG - Strukturalne dane JSON-LD dla wyszukiwarek
 * 3. OPEN GRAPH - Podgląd przy udostępnianiu na Facebook
 * 4. TWITTER CARDS - Podgląd przy udostępnianiu na Twitter/X
 * 5. CANONICAL - Zapobiega duplikacji treści
 * 6. ROBOTS - Kontrola indeksowania przez Google
 *
 * Plik działa automatycznie po umieszczeniu w /wp-content/mu-plugins/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Klasa modułu SEO
 */
class HND_SEO_Module {

    /**
     * Instancja singletona
     */
    private static $instance = null;

    /**
     * Ustawienia modułu
     */
    private $settings = array();

    /**
     * Dane hotelu dla Schema.org
     */
    private $hotel_data = array();

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
        $this->load_settings();
        $this->set_hotel_data();
        $this->init_hooks();
    }

    /**
     * Załaduj ustawienia
     */
    private function load_settings() {
        $defaults = array(
            'meta_tags'      => true,
            'schema_org'     => true,
            'open_graph'     => true,
            'twitter_cards'  => true,
            'canonical'      => true,
            'robots_meta'    => true,
            'breadcrumbs'    => true,
            'sitemap_ping'   => true,
        );

        $saved = get_option( 'hnd_seo_settings', array() );
        $this->settings = wp_parse_args( $saved, $defaults );
    }

    /**
     * Ustaw dane hotelu
     */
    private function set_hotel_data() {
        $this->hotel_data = array(
            'name'           => 'Hotel Nowy Dwór',
            'description'    => 'Hotel Nowy Dwór w Trzebnicy - 28 komfortowych pokoi, restauracja, sale weselne i konferencyjne. 15 km od Wrocławia.',
            'url'            => 'https://www.hotelnowydwor.eu/',
            'logo'           => 'https://www.hotelnowydwor.eu/wp-content/uploads/logo-hotel-nowy-dwor.png',
            'image'          => 'https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-exterior.jpg',
            'telephone'      => '+48 71 312 07 14',
            'email'          => 'rezerwacja@hotelnowydwor.eu',
            'address'        => array(
                'street'     => 'ul. Nowy Dwór 2',
                'city'       => 'Trzebnica',
                'postalCode' => '55-100',
                'country'    => 'PL',
            ),
            'geo'            => array(
                'latitude'   => '51.3094',
                'longitude'  => '17.0633',
            ),
            'priceRange'     => '$$',
            'numberOfRooms'  => 28,
            'checkIn'        => '14:00',
            'checkOut'       => '11:00',
            'amenities'      => array(
                'Restauracja',
                'Sala weselna',
                'Sala konferencyjna',
                'Parking',
                'Wi-Fi',
                'Klimatyzacja',
                'Recepcja 24h',
            ),
        );

        // Pozwól na nadpisanie przez filtry
        $this->hotel_data = apply_filters( 'hnd_seo_hotel_data', $this->hotel_data );
    }

    /**
     * Inicjalizuj hooki
     */
    private function init_hooks() {
        // Meta tagi i SEO w head
        add_action( 'wp_head', array( $this, 'output_meta_tags' ), 1 );
        add_action( 'wp_head', array( $this, 'output_canonical' ), 2 );
        add_action( 'wp_head', array( $this, 'output_robots_meta' ), 3 );
        add_action( 'wp_head', array( $this, 'output_open_graph' ), 4 );
        add_action( 'wp_head', array( $this, 'output_twitter_cards' ), 5 );
        add_action( 'wp_head', array( $this, 'output_schema_org' ), 6 );

        // Breadcrumbs Schema
        add_action( 'wp_head', array( $this, 'output_breadcrumbs_schema' ), 7 );

        // Optymalizacja title
        add_filter( 'pre_get_document_title', array( $this, 'optimize_title' ), 10 );
        add_filter( 'document_title_separator', array( $this, 'title_separator' ) );

        // Usuń niepotrzebne meta z head
        add_action( 'init', array( $this, 'cleanup_head' ) );

        // Ping sitemap po aktualizacji
        add_action( 'save_post', array( $this, 'ping_search_engines' ) );

        // Dodaj hreflang dla języków
        add_action( 'wp_head', array( $this, 'output_hreflang' ), 8 );
    }

    /**
     * Wyczyść niepotrzebne tagi z head
     */
    public function cleanup_head() {
        // Usuń generator WordPress
        remove_action( 'wp_head', 'wp_generator' );

        // Usuń RSD link
        remove_action( 'wp_head', 'rsd_link' );

        // Usuń Windows Live Writer link
        remove_action( 'wp_head', 'wlwmanifest_link' );

        // Usuń shortlink
        remove_action( 'wp_head', 'wp_shortlink_wp_head' );

        // Usuń REST API link
        remove_action( 'wp_head', 'rest_output_link_wp_head' );

        // Usuń oEmbed discovery links
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    }

    /**
     * Wyprowadź meta tagi
     */
    public function output_meta_tags() {
        if ( ! $this->settings['meta_tags'] ) {
            return;
        }

        $description = $this->get_meta_description();
        $keywords = $this->get_meta_keywords();

        echo "\n<!-- HND SEO Module - Meta Tags -->\n";

        if ( $description ) {
            echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        }

        if ( $keywords ) {
            echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '">' . "\n";
        }

        // Autor
        echo '<meta name="author" content="Hotel Nowy Dwór">' . "\n";

        // Geo meta
        echo '<meta name="geo.region" content="PL-DS">' . "\n";
        echo '<meta name="geo.placename" content="Trzebnica">' . "\n";
        echo '<meta name="geo.position" content="' . esc_attr( $this->hotel_data['geo']['latitude'] ) . ';' . esc_attr( $this->hotel_data['geo']['longitude'] ) . '">' . "\n";
        echo '<meta name="ICBM" content="' . esc_attr( $this->hotel_data['geo']['latitude'] ) . ', ' . esc_attr( $this->hotel_data['geo']['longitude'] ) . '">' . "\n";
    }

    /**
     * Pobierz meta description
     */
    private function get_meta_description() {
        if ( is_singular() ) {
            $post = get_queried_object();

            // Sprawdź ACF
            if ( function_exists( 'get_field' ) ) {
                $custom_desc = get_field( 'meta_description', $post->ID );
                if ( $custom_desc ) {
                    return $this->truncate_description( $custom_desc );
                }
            }

            // Użyj excerpt lub content
            if ( has_excerpt( $post->ID ) ) {
                return $this->truncate_description( get_the_excerpt( $post->ID ) );
            }

            return $this->truncate_description( wp_strip_all_tags( $post->post_content ) );
        }

        if ( is_home() || is_front_page() ) {
            return $this->hotel_data['description'];
        }

        if ( is_category() || is_tag() || is_tax() ) {
            $term = get_queried_object();
            if ( $term && ! empty( $term->description ) ) {
                return $this->truncate_description( $term->description );
            }
        }

        return get_bloginfo( 'description' );
    }

    /**
     * Skróć description do 160 znaków
     */
    private function truncate_description( $text, $length = 160 ) {
        $text = wp_strip_all_tags( $text );
        $text = preg_replace( '/\s+/', ' ', $text );
        $text = trim( $text );

        if ( strlen( $text ) <= $length ) {
            return $text;
        }

        $text = substr( $text, 0, $length - 3 );
        $text = substr( $text, 0, strrpos( $text, ' ' ) );

        return $text . '...';
    }

    /**
     * Pobierz meta keywords
     */
    private function get_meta_keywords() {
        $keywords = array(
            'hotel trzebnica',
            'hotel nowy dwór',
            'noclegi trzebnica',
            'hotel wrocław',
            'wesele trzebnica',
            'sala weselna trzebnica',
            'restauracja trzebnica',
            'konferencje trzebnica',
        );

        if ( is_singular() ) {
            $tags = get_the_tags();
            if ( $tags ) {
                foreach ( $tags as $tag ) {
                    $keywords[] = $tag->name;
                }
            }
        }

        return implode( ', ', array_unique( $keywords ) );
    }

    /**
     * Wyprowadź canonical URL
     */
    public function output_canonical() {
        if ( ! $this->settings['canonical'] ) {
            return;
        }

        $canonical = $this->get_canonical_url();

        if ( $canonical ) {
            echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
        }
    }

    /**
     * Pobierz canonical URL
     */
    private function get_canonical_url() {
        if ( is_singular() ) {
            return get_permalink();
        }

        if ( is_home() || is_front_page() ) {
            return home_url( '/' );
        }

        if ( is_category() || is_tag() || is_tax() ) {
            $term = get_queried_object();
            return get_term_link( $term );
        }

        if ( is_author() ) {
            return get_author_posts_url( get_queried_object_id() );
        }

        if ( is_date() ) {
            if ( is_day() ) {
                return get_day_link( get_the_date( 'Y' ), get_the_date( 'm' ), get_the_date( 'd' ) );
            }
            if ( is_month() ) {
                return get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
            }
            return get_year_link( get_the_date( 'Y' ) );
        }

        return false;
    }

    /**
     * Wyprowadź robots meta
     */
    public function output_robots_meta() {
        if ( ! $this->settings['robots_meta'] ) {
            return;
        }

        $robots = array();

        // Strony do nieindeksowania
        if ( is_search() || is_404() ) {
            $robots[] = 'noindex';
            $robots[] = 'nofollow';
        } elseif ( is_paged() ) {
            // Strony paginacji
            $robots[] = 'noindex';
            $robots[] = 'follow';
        } else {
            $robots[] = 'index';
            $robots[] = 'follow';
        }

        // Max snippet i image preview
        $robots[] = 'max-snippet:-1';
        $robots[] = 'max-image-preview:large';
        $robots[] = 'max-video-preview:-1';

        echo '<meta name="robots" content="' . esc_attr( implode( ', ', $robots ) ) . '">' . "\n";
    }

    /**
     * Wyprowadź Open Graph
     */
    public function output_open_graph() {
        if ( ! $this->settings['open_graph'] ) {
            return;
        }

        echo "\n<!-- HND SEO Module - Open Graph -->\n";

        // Podstawowe OG
        echo '<meta property="og:locale" content="pl_PL">' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr( $this->hotel_data['name'] ) . '">' . "\n";

        if ( is_singular() ) {
            $post = get_queried_object();
            echo '<meta property="og:type" content="article">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr( $this->get_meta_description() ) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";

            // Obrazek
            $image = $this->get_og_image( $post->ID );
            if ( $image ) {
                echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
                echo '<meta property="og:image:width" content="1200">' . "\n";
                echo '<meta property="og:image:height" content="630">' . "\n";
            }

            // Daty artykułu
            echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '">' . "\n";
            echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . "\n";

        } else {
            echo '<meta property="og:type" content="website">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr( $this->hotel_data['name'] ) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr( $this->hotel_data['description'] ) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url( home_url( '/' ) ) . '">' . "\n";
            echo '<meta property="og:image" content="' . esc_url( $this->hotel_data['image'] ) . '">' . "\n";
        }

        // Facebook App ID (opcjonalne)
        $fb_app_id = apply_filters( 'hnd_seo_facebook_app_id', '' );
        if ( $fb_app_id ) {
            echo '<meta property="fb:app_id" content="' . esc_attr( $fb_app_id ) . '">' . "\n";
        }
    }

    /**
     * Pobierz obrazek OG
     */
    private function get_og_image( $post_id = null ) {
        if ( $post_id && has_post_thumbnail( $post_id ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );
            if ( $image ) {
                return $image[0];
            }
        }

        return $this->hotel_data['image'];
    }

    /**
     * Wyprowadź Twitter Cards
     */
    public function output_twitter_cards() {
        if ( ! $this->settings['twitter_cards'] ) {
            return;
        }

        echo "\n<!-- HND SEO Module - Twitter Cards -->\n";

        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:site" content="@hotelnowydwor">' . "\n";

        if ( is_singular() ) {
            echo '<meta name="twitter:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
            echo '<meta name="twitter:description" content="' . esc_attr( $this->get_meta_description() ) . '">' . "\n";

            $image = $this->get_og_image( get_queried_object_id() );
            if ( $image ) {
                echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
            }
        } else {
            echo '<meta name="twitter:title" content="' . esc_attr( $this->hotel_data['name'] ) . '">' . "\n";
            echo '<meta name="twitter:description" content="' . esc_attr( $this->hotel_data['description'] ) . '">' . "\n";
            echo '<meta name="twitter:image" content="' . esc_url( $this->hotel_data['image'] ) . '">' . "\n";
        }
    }

    /**
     * Wyprowadź Schema.org JSON-LD
     */
    public function output_schema_org() {
        if ( ! $this->settings['schema_org'] ) {
            return;
        }

        echo "\n<!-- HND SEO Module - Schema.org -->\n";

        // Główny schemat Hotel
        $hotel_schema = $this->get_hotel_schema();
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $hotel_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        echo "\n</script>\n";

        // Schemat WebSite
        $website_schema = $this->get_website_schema();
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $website_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        echo "\n</script>\n";

        // Schemat Organization
        $org_schema = $this->get_organization_schema();
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $org_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        echo "\n</script>\n";

        // Schemat dla pojedynczego posta
        if ( is_singular( 'post' ) ) {
            $article_schema = $this->get_article_schema();
            echo '<script type="application/ld+json">' . "\n";
            echo wp_json_encode( $article_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
            echo "\n</script>\n";
        }

        // Schemat LocalBusiness dla podstron
        if ( is_page( array( 'kontakt', 'contact' ) ) ) {
            $local_schema = $this->get_local_business_schema();
            echo '<script type="application/ld+json">' . "\n";
            echo wp_json_encode( $local_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
            echo "\n</script>\n";
        }

        // Schemat FAQ
        if ( is_page( array( 'faq', 'pytania', 'czesto-zadawane-pytania' ) ) ) {
            $faq_schema = $this->get_faq_schema();
            if ( $faq_schema ) {
                echo '<script type="application/ld+json">' . "\n";
                echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
                echo "\n</script>\n";
            }
        }
    }

    /**
     * Schemat Hotel
     */
    private function get_hotel_schema() {
        return array(
            '@context'         => 'https://schema.org',
            '@type'            => 'Hotel',
            '@id'              => $this->hotel_data['url'] . '#hotel',
            'name'             => $this->hotel_data['name'],
            'description'      => $this->hotel_data['description'],
            'url'              => $this->hotel_data['url'],
            'logo'             => $this->hotel_data['logo'],
            'image'            => $this->hotel_data['image'],
            'telephone'        => $this->hotel_data['telephone'],
            'email'            => $this->hotel_data['email'],
            'priceRange'       => $this->hotel_data['priceRange'],
            'numberOfRooms'    => $this->hotel_data['numberOfRooms'],
            'checkinTime'      => $this->hotel_data['checkIn'],
            'checkoutTime'     => $this->hotel_data['checkOut'],
            'address'          => array(
                '@type'           => 'PostalAddress',
                'streetAddress'   => $this->hotel_data['address']['street'],
                'addressLocality' => $this->hotel_data['address']['city'],
                'postalCode'      => $this->hotel_data['address']['postalCode'],
                'addressCountry'  => $this->hotel_data['address']['country'],
            ),
            'geo'              => array(
                '@type'     => 'GeoCoordinates',
                'latitude'  => $this->hotel_data['geo']['latitude'],
                'longitude' => $this->hotel_data['geo']['longitude'],
            ),
            'amenityFeature'   => array_map( function( $amenity ) {
                return array(
                    '@type' => 'LocationFeatureSpecification',
                    'name'  => $amenity,
                );
            }, $this->hotel_data['amenities'] ),
            'sameAs'           => array(
                'https://www.facebook.com/hotelnowydwor/',
                'https://www.instagram.com/hotelnowydwor/',
            ),
            'potentialAction'  => array(
                '@type'  => 'ReserveAction',
                'target' => array(
                    '@type'       => 'EntryPoint',
                    'urlTemplate' => $this->hotel_data['url'] . 'rezerwacja/',
                    'actionPlatform' => array(
                        'http://schema.org/DesktopWebPlatform',
                        'http://schema.org/MobileWebPlatform',
                    ),
                ),
                'result' => array(
                    '@type' => 'LodgingReservation',
                    'name'  => 'Rezerwacja pokoju',
                ),
            ),
        );
    }

    /**
     * Schemat WebSite
     */
    private function get_website_schema() {
        return array(
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            '@id'             => $this->hotel_data['url'] . '#website',
            'name'            => $this->hotel_data['name'],
            'url'             => $this->hotel_data['url'],
            'inLanguage'      => 'pl-PL',
            'publisher'       => array(
                '@id' => $this->hotel_data['url'] . '#organization',
            ),
            'potentialAction' => array(
                '@type'       => 'SearchAction',
                'target'      => array(
                    '@type'        => 'EntryPoint',
                    'urlTemplate'  => $this->hotel_data['url'] . '?s={search_term_string}',
                ),
                'query-input' => 'required name=search_term_string',
            ),
        );
    }

    /**
     * Schemat Organization
     */
    private function get_organization_schema() {
        return array(
            '@context'    => 'https://schema.org',
            '@type'       => 'Organization',
            '@id'         => $this->hotel_data['url'] . '#organization',
            'name'        => $this->hotel_data['name'],
            'url'         => $this->hotel_data['url'],
            'logo'        => array(
                '@type'      => 'ImageObject',
                '@id'        => $this->hotel_data['url'] . '#logo',
                'url'        => $this->hotel_data['logo'],
                'contentUrl' => $this->hotel_data['logo'],
                'caption'    => $this->hotel_data['name'],
            ),
            'contactPoint' => array(
                '@type'             => 'ContactPoint',
                'telephone'         => $this->hotel_data['telephone'],
                'email'             => $this->hotel_data['email'],
                'contactType'       => 'reservations',
                'areaServed'        => 'PL',
                'availableLanguage' => array( 'Polish', 'English', 'German' ),
            ),
        );
    }

    /**
     * Schemat Article
     */
    private function get_article_schema() {
        $post = get_queried_object();

        return array(
            '@context'         => 'https://schema.org',
            '@type'            => 'Article',
            'headline'         => get_the_title(),
            'description'      => $this->get_meta_description(),
            'url'              => get_permalink(),
            'datePublished'    => get_the_date( 'c' ),
            'dateModified'     => get_the_modified_date( 'c' ),
            'author'           => array(
                '@type' => 'Organization',
                'name'  => $this->hotel_data['name'],
            ),
            'publisher'        => array(
                '@type' => 'Organization',
                'name'  => $this->hotel_data['name'],
                'logo'  => array(
                    '@type' => 'ImageObject',
                    'url'   => $this->hotel_data['logo'],
                ),
            ),
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id'   => get_permalink(),
            ),
            'image'            => $this->get_og_image( $post->ID ),
        );
    }

    /**
     * Schemat LocalBusiness
     */
    private function get_local_business_schema() {
        return array(
            '@context'       => 'https://schema.org',
            '@type'          => 'LodgingBusiness',
            'name'           => $this->hotel_data['name'],
            'description'    => $this->hotel_data['description'],
            'url'            => $this->hotel_data['url'],
            'telephone'      => $this->hotel_data['telephone'],
            'email'          => $this->hotel_data['email'],
            'priceRange'     => $this->hotel_data['priceRange'],
            'address'        => array(
                '@type'           => 'PostalAddress',
                'streetAddress'   => $this->hotel_data['address']['street'],
                'addressLocality' => $this->hotel_data['address']['city'],
                'postalCode'      => $this->hotel_data['address']['postalCode'],
                'addressCountry'  => $this->hotel_data['address']['country'],
            ),
            'geo'            => array(
                '@type'     => 'GeoCoordinates',
                'latitude'  => $this->hotel_data['geo']['latitude'],
                'longitude' => $this->hotel_data['geo']['longitude'],
            ),
            'openingHoursSpecification' => array(
                array(
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => array(
                        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
                    ),
                    'opens'     => '00:00',
                    'closes'    => '23:59',
                ),
            ),
        );
    }

    /**
     * Schemat FAQ
     */
    private function get_faq_schema() {
        // Sprawdź czy mamy FAQ z ACF
        if ( ! function_exists( 'get_field' ) ) {
            return $this->get_default_faq_schema();
        }

        $faq_items = get_field( 'faq_items' );
        if ( ! $faq_items || ! is_array( $faq_items ) ) {
            return $this->get_default_faq_schema();
        }

        $questions = array();
        foreach ( $faq_items as $item ) {
            if ( ! empty( $item['question'] ) && ! empty( $item['answer'] ) ) {
                $questions[] = array(
                    '@type'          => 'Question',
                    'name'           => $item['question'],
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => wp_strip_all_tags( $item['answer'] ),
                    ),
                );
            }
        }

        if ( empty( $questions ) ) {
            return $this->get_default_faq_schema();
        }

        return array(
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $questions,
        );
    }

    /**
     * Domyślny schemat FAQ
     */
    private function get_default_faq_schema() {
        $default_faq = array(
            array(
                'question' => 'O której godzinie jest zameldowanie i wymeldowanie?',
                'answer'   => 'Zameldowanie (check-in) od godziny 14:00. Wymeldowanie (check-out) do godziny 11:00.',
            ),
            array(
                'question' => 'Czy hotel posiada parking?',
                'answer'   => 'Tak, hotel dysponuje bezpłatnym parkingiem dla gości.',
            ),
            array(
                'question' => 'Czy w hotelu jest restauracja?',
                'answer'   => 'Tak, hotel posiada restaurację serwującą dania kuchni polskiej i europejskiej.',
            ),
            array(
                'question' => 'Czy organizujecie wesela?',
                'answer'   => 'Tak, oferujemy profesjonalną organizację wesel i przyjęć okolicznościowych w naszych salach.',
            ),
            array(
                'question' => 'Jak daleko jest do Wrocławia?',
                'answer'   => 'Hotel znajduje się w odległości około 15 km od centrum Wrocławia, czyli około 20 minut jazdy samochodem.',
            ),
        );

        $questions = array();
        foreach ( $default_faq as $item ) {
            $questions[] = array(
                '@type'          => 'Question',
                'name'           => $item['question'],
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => $item['answer'],
                ),
            );
        }

        return array(
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $questions,
        );
    }

    /**
     * Wyprowadź schemat breadcrumbs
     */
    public function output_breadcrumbs_schema() {
        if ( ! $this->settings['breadcrumbs'] ) {
            return;
        }

        if ( is_front_page() ) {
            return;
        }

        $breadcrumbs = $this->get_breadcrumbs();
        if ( empty( $breadcrumbs ) ) {
            return;
        }

        $schema = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array(),
        );

        $position = 1;
        foreach ( $breadcrumbs as $crumb ) {
            $schema['itemListElement'][] = array(
                '@type'    => 'ListItem',
                'position' => $position,
                'name'     => $crumb['name'],
                'item'     => $crumb['url'],
            );
            $position++;
        }

        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        echo "\n</script>\n";
    }

    /**
     * Pobierz breadcrumbs
     */
    private function get_breadcrumbs() {
        $breadcrumbs = array();

        // Strona główna
        $breadcrumbs[] = array(
            'name' => 'Strona główna',
            'url'  => home_url( '/' ),
        );

        if ( is_singular() ) {
            $post = get_queried_object();

            // Kategoria dla postów
            if ( is_single() ) {
                $categories = get_the_category();
                if ( $categories ) {
                    $breadcrumbs[] = array(
                        'name' => $categories[0]->name,
                        'url'  => get_category_link( $categories[0]->term_id ),
                    );
                }
            }

            // Strona rodzica dla stron hierarchicznych
            if ( is_page() && $post->post_parent ) {
                $ancestors = get_post_ancestors( $post->ID );
                $ancestors = array_reverse( $ancestors );

                foreach ( $ancestors as $ancestor_id ) {
                    $breadcrumbs[] = array(
                        'name' => get_the_title( $ancestor_id ),
                        'url'  => get_permalink( $ancestor_id ),
                    );
                }
            }

            // Aktualna strona
            $breadcrumbs[] = array(
                'name' => get_the_title(),
                'url'  => get_permalink(),
            );

        } elseif ( is_category() || is_tag() || is_tax() ) {
            $term = get_queried_object();
            $breadcrumbs[] = array(
                'name' => $term->name,
                'url'  => get_term_link( $term ),
            );

        } elseif ( is_search() ) {
            $breadcrumbs[] = array(
                'name' => 'Wyniki wyszukiwania: ' . get_search_query(),
                'url'  => get_search_link(),
            );

        } elseif ( is_404() ) {
            $breadcrumbs[] = array(
                'name' => 'Strona nie znaleziona',
                'url'  => '',
            );
        }

        return $breadcrumbs;
    }

    /**
     * Wyprowadź hreflang
     */
    public function output_hreflang() {
        // Domyślnie tylko polski
        echo '<link rel="alternate" hreflang="pl" href="' . esc_url( $this->get_canonical_url() ) . '">' . "\n";
        echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $this->get_canonical_url() ) . '">' . "\n";

        // Filtry dla wielojęzyczności
        $hreflangs = apply_filters( 'hnd_seo_hreflangs', array() );
        foreach ( $hreflangs as $lang => $url ) {
            echo '<link rel="alternate" hreflang="' . esc_attr( $lang ) . '" href="' . esc_url( $url ) . '">' . "\n";
        }
    }

    /**
     * Optymalizuj title
     */
    public function optimize_title( $title ) {
        if ( is_front_page() ) {
            return $this->hotel_data['name'] . ' - Hotel w Trzebnicy | Noclegi, Restauracja, Wesela';
        }

        if ( is_singular() ) {
            // Sprawdź ACF
            if ( function_exists( 'get_field' ) ) {
                $custom_title = get_field( 'seo_title', get_queried_object_id() );
                if ( $custom_title ) {
                    return $custom_title;
                }
            }
        }

        return $title;
    }

    /**
     * Separator title
     */
    public function title_separator( $sep ) {
        return '|';
    }

    /**
     * Ping wyszukiwarek po aktualizacji
     */
    public function ping_search_engines( $post_id ) {
        if ( ! $this->settings['sitemap_ping'] ) {
            return;
        }

        // Tylko dla opublikowanych postów
        if ( get_post_status( $post_id ) !== 'publish' ) {
            return;
        }

        // Nie pinguj dla autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Sprawdź czy już nie pingowaliśmy ostatnio
        $last_ping = get_transient( 'hnd_seo_last_ping' );
        if ( $last_ping ) {
            return;
        }

        // Ustaw transient na 1 godzinę
        set_transient( 'hnd_seo_last_ping', true, HOUR_IN_SECONDS );

        // Sitemap URL
        $sitemap_url = home_url( '/sitemap.xml' );

        // Google
        wp_remote_get( 'https://www.google.com/ping?sitemap=' . urlencode( $sitemap_url ), array(
            'timeout'   => 3,
            'blocking'  => false,
            'sslverify' => false,
        ) );

        // Bing
        wp_remote_get( 'https://www.bing.com/ping?sitemap=' . urlencode( $sitemap_url ), array(
            'timeout'   => 3,
            'blocking'  => false,
            'sslverify' => false,
        ) );
    }

    /**
     * Aktualizuj ustawienia
     */
    public function update_settings( $new_settings ) {
        $this->settings = wp_parse_args( $new_settings, $this->settings );
        update_option( 'hnd_seo_settings', $this->settings );
    }

    /**
     * Pobierz ustawienia
     */
    public function get_settings() {
        return $this->settings;
    }

    /**
     * Pobierz dane hotelu
     */
    public function get_hotel_data() {
        return $this->hotel_data;
    }
}

// Inicjalizuj moduł
add_action( 'plugins_loaded', function() {
    HND_SEO_Module::get_instance();
}, 5 );

// Funkcja pomocnicza
function hnd_seo() {
    return HND_SEO_Module::get_instance();
}
