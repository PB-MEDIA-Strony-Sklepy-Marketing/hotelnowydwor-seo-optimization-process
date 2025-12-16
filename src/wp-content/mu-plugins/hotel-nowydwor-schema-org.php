<?php
/**
 * Plugin Name: PB MEDIA - Hotel Nowy Dwór Schema.org
 * Description: Strukturyzowane dane Schema.org dla hotelu: Hotel, LocalBusiness, Restaurant, FAQPage, BreadcrumbList, WebSite.
 * Version: 1.0
 * Author: PB MEDIA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Główna klasa Schema.org.
 */
class Hotel_Nowydwor_Schema_Org {

	/**
	 * Dane hotelu.
	 */
	private $hotel = array(
		'name'             => 'Hotel Nowy Dwór',
		'alternateName'    => 'Hotel Nowy Dwor Trzebnica',
		'description'      => 'Hotel Nowy Dwór w Trzebnicy to komfortowy 28-pokojowy hotel z restauracją, położony 15 km od Wrocławia. Oferujemy noclegi, sale weselne, konferencyjne oraz profesjonalną obsługę gastronomiczną.',
		'url'              => 'https://www.hotelnowydwor.eu/',
		'telephone'        => '+48713120714',
		'email'            => 'rezerwacja@hotelnowydwor.eu',
		'priceRange'       => '150-400 PLN',
		'currenciesAccepted' => 'PLN',
		'paymentAccepted'  => 'Cash, Credit Card, Bank Transfer',
		'numberOfRooms'    => 28,
		'checkinTime'      => '14:00',
		'checkoutTime'     => '11:00',
		'starRating'       => 3,
		'petsAllowed'      => true,
		'address'          => array(
			'streetAddress'   => 'ul. Nowy Dwór 2',
			'addressLocality' => 'Trzebnica',
			'postalCode'      => '55-100',
			'addressRegion'   => 'dolnośląskie',
			'addressCountry'  => 'PL',
		),
		'geo'              => array(
			'latitude'  => 51.3094,
			'longitude' => 17.0633,
		),
		'openingHours'     => array(
			'Mo-Su 00:00-24:00', // Recepcja 24h.
		),
		'image'            => '/wp-content/uploads/hotel-nowy-dwor-trzebnica.jpg',
		'logo'             => '/wp-content/uploads/logo-hotel-nowy-dwor.png',
		'sameAs'           => array(
			'https://www.facebook.com/hotelnowydwor',
			'https://www.instagram.com/hotelnowydwor/',
			'https://www.google.com/maps/place/Hotel+Nowy+Dw%C3%B3r/',
		),
	);

	/**
	 * Dane restauracji.
	 */
	private $restaurant = array(
		'name'             => 'Restauracja Hotel Nowy Dwór',
		'description'      => 'Restauracja hotelowa serwująca tradycyjną kuchnię polską. Śniadania, obiady, kolacje. Organizacja przyjęć weselnych i bankietów do 150 osób.',
		'servesCuisine'    => array( 'Polish', 'European', 'Traditional' ),
		'priceRange'       => '$$',
		'openingHours'     => array(
			'Mo-Su 07:00-22:00',
		),
		'menu'             => 'https://hotelnowydwor.eu/restauracja/menu/',
		'acceptsReservations' => true,
	);

	/**
	 * FAQ - pytania i odpowiedzi.
	 */
	private $faq_items = array(
		array(
			'question' => 'O której godzinie jest zameldowanie (check-in) w hotelu?',
			'answer'   => 'Zameldowanie (check-in) w Hotelu Nowy Dwór jest możliwe od godziny 14:00. Wcześniejsze zameldowanie jest możliwe po wcześniejszym uzgodnieniu z recepcją, w zależności od dostępności pokoi.',
		),
		array(
			'question' => 'O której godzinie jest wymeldowanie (check-out)?',
			'answer'   => 'Wymeldowanie (check-out) z Hotelu Nowy Dwór następuje do godziny 11:00. Późniejsze wymeldowanie jest możliwe za dodatkową opłatą, po wcześniejszym uzgodnieniu z recepcją.',
		),
		array(
			'question' => 'Czy hotel posiada bezpłatny parking?',
			'answer'   => 'Tak, Hotel Nowy Dwór oferuje bezpłatny parking dla gości hotelowych. Parking jest niestrzeżony, ale oświetlony i monitorowany.',
		),
		array(
			'question' => 'Czy w hotelu jest WiFi?',
			'answer'   => 'Tak, w całym hotelu dostępne jest bezpłatne WiFi. Hasło do sieci otrzymasz przy zameldowaniu w recepcji.',
		),
		array(
			'question' => 'Czy można przyjechać ze zwierzęciem?',
			'answer'   => 'Tak, Hotel Nowy Dwór akceptuje zwierzęta domowe. Pobyt ze zwierzęciem wiąże się z dodatkową opłatą. Prosimy o wcześniejszą informację przy rezerwacji.',
		),
		array(
			'question' => 'Jak daleko jest hotel od Wrocławia?',
			'answer'   => 'Hotel Nowy Dwór znajduje się w Trzebnicy, około 15 km na północ od centrum Wrocławia. Dojazd samochodem zajmuje około 20-25 minut.',
		),
		array(
			'question' => 'Czy hotel organizuje wesela?',
			'answer'   => 'Tak, Hotel Nowy Dwór specjalizuje się w organizacji wesel i przyjęć. Dysponujemy salami weselnymi dla 50-150 gości, oferujemy pełen catering, dekoracje i noclegi dla gości weselnych.',
		),
		array(
			'question' => 'Czy hotel posiada sale konferencyjne?',
			'answer'   => 'Tak, posiadamy sale konferencyjne z pełnym wyposażeniem multimedialnym (projektor, ekran, flipchart, WiFi). Oferujemy również catering podczas konferencji i przerwy kawowe.',
		),
		array(
			'question' => 'Jakie formy płatności są akceptowane?',
			'answer'   => 'Akceptujemy płatności gotówką, kartami płatniczymi (Visa, Mastercard) oraz przelewem bankowym (przy wcześniejszej rezerwacji).',
		),
		array(
			'question' => 'Czy śniadanie jest wliczone w cenę pokoju?',
			'answer'   => 'Śniadanie w formie bufetu jest wliczone w cenę pokoju. Śniadania serwowane są w restauracji hotelowej w godzinach 7:00-10:00.',
		),
		array(
			'question' => 'Jak mogę zarezerwować pokój?',
			'answer'   => 'Pokój można zarezerwować telefonicznie pod numerem +48 71 312 07 14, mailowo na adres rezerwacja@hotelnowydwor.eu lub poprzez formularz kontaktowy na stronie internetowej.',
		),
		array(
			'question' => 'Jaka jest polityka anulowania rezerwacji?',
			'answer'   => 'Bezpłatne anulowanie rezerwacji jest możliwe do 24 godzin przed planowanym przyjazdem. W przypadku późniejszego anulowania lub niestawienia się, pobierana jest opłata za pierwszą noc pobytu.',
		),
	);

	/**
	 * Konstruktor.
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'output_schema' ), 10 );
		add_action( 'wp_footer', array( $this, 'output_breadcrumb_schema' ), 99 );
	}

	/**
	 * Główne wyjście Schema.org.
	 */
	public function output_schema() {
		$schemas = array();

		// Zawsze dodaj WebSite schema.
		$schemas[] = $this->get_website_schema();

		// Zawsze dodaj Organization schema.
		$schemas[] = $this->get_organization_schema();

		// Na stronie głównej - Hotel schema.
		if ( is_front_page() || is_home() ) {
			$schemas[] = $this->get_hotel_schema();
		}

		// Na stronie restauracji - Restaurant schema.
		$slug = $this->get_current_slug();
		if ( in_array( $slug, array( 'restauracja', 'menu' ), true ) ) {
			$schemas[] = $this->get_restaurant_schema();
		}

		// Na stronie FAQ - FAQPage schema.
		if ( 'faq' === $slug ) {
			$schemas[] = $this->get_faq_schema();
		}

		// Na stronach pokoi - LodgingBusiness.
		if ( 'pokoje' === $slug ) {
			$schemas[] = $this->get_lodging_schema();
		}

		// Na stronie kontakt - LocalBusiness z dodatkowymi danymi.
		if ( 'kontakt' === $slug ) {
			$schemas[] = $this->get_contact_schema();
		}

		// BreadcrumbList - zawsze (chyba że strona główna).
		if ( ! is_front_page() ) {
			$schemas[] = $this->get_breadcrumb_schema();
		}

		// Wyjście JSON-LD.
		if ( ! empty( $schemas ) ) {
			echo "\n<!-- Schema.org Structured Data - Hotel Nowy Dwór -->\n";
			foreach ( $schemas as $schema ) {
				if ( ! empty( $schema ) ) {
					echo '<script type="application/ld+json">' . "\n";
					echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
					echo "\n</script>\n";
				}
			}
		}
	}

	/**
	 * Pobierz aktualny slug strony.
	 */
	private function get_current_slug() {
		if ( is_front_page() || is_home() ) {
			return 'home';
		}

		if ( is_page() || is_singular() ) {
			return get_post_field( 'post_name', get_queried_object_id() );
		}

		return '';
	}

	/**
	 * Schema WebSite.
	 */
	private function get_website_schema() {
		return array(
			'@context'        => 'https://schema.org',
			'@type'           => 'WebSite',
			'@id'             => $this->hotel['url'] . '#website',
			'url'             => $this->hotel['url'],
			'name'            => $this->hotel['name'],
			'description'     => $this->hotel['description'],
			'inLanguage'      => 'pl-PL',
			'publisher'       => array(
				'@id' => $this->hotel['url'] . '#organization',
			),
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => array(
					'@type'       => 'EntryPoint',
					'urlTemplate' => $this->hotel['url'] . '?s={search_term_string}',
				),
				'query-input' => 'required name=search_term_string',
			),
		);
	}

	/**
	 * Schema Organization.
	 */
	private function get_organization_schema() {
		return array(
			'@context'      => 'https://schema.org',
			'@type'         => 'Organization',
			'@id'           => $this->hotel['url'] . '#organization',
			'name'          => $this->hotel['name'],
			'url'           => $this->hotel['url'],
			'logo'          => array(
				'@type'  => 'ImageObject',
				'url'    => home_url( $this->hotel['logo'] ),
				'width'  => 300,
				'height' => 100,
			),
			'image'         => home_url( $this->hotel['image'] ),
			'telephone'     => $this->hotel['telephone'],
			'email'         => $this->hotel['email'],
			'address'       => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $this->hotel['address']['streetAddress'],
				'addressLocality' => $this->hotel['address']['addressLocality'],
				'postalCode'      => $this->hotel['address']['postalCode'],
				'addressRegion'   => $this->hotel['address']['addressRegion'],
				'addressCountry'  => $this->hotel['address']['addressCountry'],
			),
			'geo'           => array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => $this->hotel['geo']['latitude'],
				'longitude' => $this->hotel['geo']['longitude'],
			),
			'sameAs'        => $this->hotel['sameAs'],
			'contactPoint'  => array(
				'@type'             => 'ContactPoint',
				'telephone'         => $this->hotel['telephone'],
				'contactType'       => 'reservations',
				'availableLanguage' => array( 'Polish', 'English' ),
				'areaServed'        => 'PL',
			),
		);
	}

	/**
	 * Schema Hotel.
	 */
	private function get_hotel_schema() {
		return array(
			'@context'              => 'https://schema.org',
			'@type'                 => 'Hotel',
			'@id'                   => $this->hotel['url'] . '#hotel',
			'name'                  => $this->hotel['name'],
			'alternateName'         => $this->hotel['alternateName'],
			'description'           => $this->hotel['description'],
			'url'                   => $this->hotel['url'],
			'telephone'             => $this->hotel['telephone'],
			'email'                 => $this->hotel['email'],
			'priceRange'            => $this->hotel['priceRange'],
			'currenciesAccepted'    => $this->hotel['currenciesAccepted'],
			'paymentAccepted'       => $this->hotel['paymentAccepted'],
			'numberOfRooms'         => $this->hotel['numberOfRooms'],
			'checkinTime'           => $this->hotel['checkinTime'],
			'checkoutTime'          => $this->hotel['checkoutTime'],
			'petsAllowed'           => $this->hotel['petsAllowed'],
			'starRating'            => array(
				'@type'       => 'Rating',
				'ratingValue' => $this->hotel['starRating'],
				'bestRating'  => 5,
			),
			'address'               => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $this->hotel['address']['streetAddress'],
				'addressLocality' => $this->hotel['address']['addressLocality'],
				'postalCode'      => $this->hotel['address']['postalCode'],
				'addressRegion'   => $this->hotel['address']['addressRegion'],
				'addressCountry'  => $this->hotel['address']['addressCountry'],
			),
			'geo'                   => array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => $this->hotel['geo']['latitude'],
				'longitude' => $this->hotel['geo']['longitude'],
			),
			'image'                 => home_url( $this->hotel['image'] ),
			'logo'                  => home_url( $this->hotel['logo'] ),
			'sameAs'                => $this->hotel['sameAs'],
			'openingHoursSpecification' => array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array(
					'Monday',
					'Tuesday',
					'Wednesday',
					'Thursday',
					'Friday',
					'Saturday',
					'Sunday',
				),
				'opens'     => '00:00',
				'closes'    => '23:59',
			),
			'amenityFeature'        => array(
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Restauracja',
					'value' => true,
				),
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Bezpłatny parking',
					'value' => true,
				),
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Bezpłatne WiFi',
					'value' => true,
				),
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Sale konferencyjne',
					'value' => true,
				),
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Sale weselne',
					'value' => true,
				),
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Klimatyzacja',
					'value' => true,
				),
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Recepcja 24h',
					'value' => true,
				),
				array(
					'@type' => 'LocationFeatureSpecification',
					'name'  => 'Akceptacja zwierząt',
					'value' => true,
				),
			),
			'hasMap'                => 'https://www.google.com/maps/place/Hotel+Nowy+Dw%C3%B3r/',
			'potentialAction'       => array(
				'@type'  => 'ReserveAction',
				'target' => array(
					'@type'       => 'EntryPoint',
					'urlTemplate' => $this->hotel['url'] . 'kontakt/',
					'actionPlatform' => array(
						'http://schema.org/DesktopWebPlatform',
						'http://schema.org/MobileWebPlatform',
					),
				),
				'result' => array(
					'@type' => 'LodgingReservation',
					'name'  => 'Rezerwacja pokoju hotelowego',
				),
			),
		);
	}

	/**
	 * Schema Restaurant.
	 */
	private function get_restaurant_schema() {
		return array(
			'@context'              => 'https://schema.org',
			'@type'                 => 'Restaurant',
			'@id'                   => $this->hotel['url'] . 'restauracja/#restaurant',
			'name'                  => $this->restaurant['name'],
			'description'           => $this->restaurant['description'],
			'url'                   => $this->hotel['url'] . 'restauracja/',
			'telephone'             => $this->hotel['telephone'],
			'email'                 => $this->hotel['email'],
			'servesCuisine'         => $this->restaurant['servesCuisine'],
			'priceRange'            => $this->restaurant['priceRange'],
			'menu'                  => $this->restaurant['menu'],
			'acceptsReservations'   => $this->restaurant['acceptsReservations'],
			'address'               => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $this->hotel['address']['streetAddress'],
				'addressLocality' => $this->hotel['address']['addressLocality'],
				'postalCode'      => $this->hotel['address']['postalCode'],
				'addressCountry'  => $this->hotel['address']['addressCountry'],
			),
			'geo'                   => array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => $this->hotel['geo']['latitude'],
				'longitude' => $this->hotel['geo']['longitude'],
			),
			'image'                 => home_url( $this->hotel['image'] ),
			'openingHoursSpecification' => array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array(
					'Monday',
					'Tuesday',
					'Wednesday',
					'Thursday',
					'Friday',
					'Saturday',
					'Sunday',
				),
				'opens'     => '07:00',
				'closes'    => '22:00',
			),
			'parentOrganization'    => array(
				'@id' => $this->hotel['url'] . '#hotel',
			),
			'potentialAction'       => array(
				'@type'  => 'ReserveAction',
				'target' => array(
					'@type'       => 'EntryPoint',
					'urlTemplate' => $this->hotel['url'] . 'kontakt/',
				),
				'result' => array(
					'@type' => 'FoodEstablishmentReservation',
					'name'  => 'Rezerwacja stolika',
				),
			),
		);
	}

	/**
	 * Schema FAQPage.
	 */
	private function get_faq_schema() {
		$main_entity = array();

		foreach ( $this->faq_items as $item ) {
			$main_entity[] = array(
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
			'@id'        => $this->hotel['url'] . 'faq/#faqpage',
			'mainEntity' => $main_entity,
		);
	}

	/**
	 * Schema LodgingBusiness dla strony pokoi.
	 */
	private function get_lodging_schema() {
		return array(
			'@context'        => 'https://schema.org',
			'@type'           => 'LodgingBusiness',
			'@id'             => $this->hotel['url'] . 'pokoje/#lodging',
			'name'            => $this->hotel['name'] . ' - Pokoje hotelowe',
			'description'     => '28 komfortowych pokoi hotelowych w różnych konfiguracjach: pokoje 1-osobowe, 2-osobowe, 3-osobowe oraz apartamenty. Wszystkie pokoje wyposażone w łazienkę, TV, WiFi.',
			'url'             => $this->hotel['url'] . 'pokoje/',
			'telephone'       => $this->hotel['telephone'],
			'priceRange'      => $this->hotel['priceRange'],
			'numberOfRooms'   => $this->hotel['numberOfRooms'],
			'checkinTime'     => $this->hotel['checkinTime'],
			'checkoutTime'    => $this->hotel['checkoutTime'],
			'address'         => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $this->hotel['address']['streetAddress'],
				'addressLocality' => $this->hotel['address']['addressLocality'],
				'postalCode'      => $this->hotel['address']['postalCode'],
				'addressCountry'  => $this->hotel['address']['addressCountry'],
			),
			'geo'             => array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => $this->hotel['geo']['latitude'],
				'longitude' => $this->hotel['geo']['longitude'],
			),
			'containsPlace'   => array(
				array(
					'@type'           => 'HotelRoom',
					'name'            => 'Pokój 1-osobowy Standard',
					'description'     => 'Przytulny pokój jednoosobowy z łazienką, TV, WiFi. Idealny dla podróżujących w pojedynkę.',
					'occupancy'       => array(
						'@type'    => 'QuantitativeValue',
						'maxValue' => 1,
					),
					'amenityFeature'  => array(
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Łazienka' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Telewizor' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'WiFi' ),
					),
				),
				array(
					'@type'           => 'HotelRoom',
					'name'            => 'Pokój 2-osobowy Standard',
					'description'     => 'Komfortowy pokój dwuosobowy z podwójnym łóżkiem lub dwoma pojedynczymi. Łazienka, TV, WiFi.',
					'occupancy'       => array(
						'@type'    => 'QuantitativeValue',
						'maxValue' => 2,
					),
					'amenityFeature'  => array(
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Łazienka' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Telewizor' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'WiFi' ),
					),
				),
				array(
					'@type'           => 'HotelRoom',
					'name'            => 'Pokój 3-osobowy',
					'description'     => 'Przestronny pokój dla rodziny lub grupy. Łóżko podwójne + pojedyncze. Łazienka, TV, WiFi.',
					'occupancy'       => array(
						'@type'    => 'QuantitativeValue',
						'maxValue' => 3,
					),
					'amenityFeature'  => array(
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Łazienka' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Telewizor' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'WiFi' ),
					),
				),
				array(
					'@type'           => 'Suite',
					'name'            => 'Apartament',
					'description'     => 'Luksusowy apartament z osobnym salonem. Klimatyzacja, minibar, TV, WiFi. Idealne dla par i VIP.',
					'occupancy'       => array(
						'@type'    => 'QuantitativeValue',
						'maxValue' => 2,
					),
					'amenityFeature'  => array(
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Łazienka' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Telewizor' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'WiFi' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Klimatyzacja' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Minibar' ),
						array( '@type' => 'LocationFeatureSpecification', 'name' => 'Salon' ),
					),
				),
			),
			'parentOrganization' => array(
				'@id' => $this->hotel['url'] . '#hotel',
			),
		);
	}

	/**
	 * Schema dla strony kontakt - LocalBusiness z mapą.
	 */
	private function get_contact_schema() {
		return array(
			'@context'      => 'https://schema.org',
			'@type'         => 'LocalBusiness',
			'@id'           => $this->hotel['url'] . 'kontakt/#localbusiness',
			'name'          => $this->hotel['name'],
			'description'   => 'Kontakt z Hotelem Nowy Dwór w Trzebnicy. Rezerwacja pokoi, zapytania o wesela i konferencje.',
			'url'           => $this->hotel['url'] . 'kontakt/',
			'telephone'     => $this->hotel['telephone'],
			'email'         => $this->hotel['email'],
			'address'       => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $this->hotel['address']['streetAddress'],
				'addressLocality' => $this->hotel['address']['addressLocality'],
				'postalCode'      => $this->hotel['address']['postalCode'],
				'addressRegion'   => $this->hotel['address']['addressRegion'],
				'addressCountry'  => $this->hotel['address']['addressCountry'],
			),
			'geo'           => array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => $this->hotel['geo']['latitude'],
				'longitude' => $this->hotel['geo']['longitude'],
			),
			'hasMap'        => 'https://www.google.com/maps/place/Hotel+Nowy+Dw%C3%B3r/',
			'image'         => home_url( $this->hotel['image'] ),
			'openingHoursSpecification' => array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
				'opens'     => '00:00',
				'closes'    => '23:59',
			),
			'contactPoint'  => array(
				array(
					'@type'             => 'ContactPoint',
					'telephone'         => $this->hotel['telephone'],
					'contactType'       => 'reservations',
					'availableLanguage' => array( 'Polish', 'English' ),
				),
				array(
					'@type'             => 'ContactPoint',
					'email'             => $this->hotel['email'],
					'contactType'       => 'customer service',
					'availableLanguage' => array( 'Polish', 'English' ),
				),
			),
			'areaServed'    => array(
				array(
					'@type' => 'City',
					'name'  => 'Trzebnica',
				),
				array(
					'@type' => 'City',
					'name'  => 'Wrocław',
				),
				array(
					'@type' => 'State',
					'name'  => 'Dolny Śląsk',
				),
			),
		);
	}

	/**
	 * Schema BreadcrumbList.
	 */
	private function get_breadcrumb_schema() {
		$breadcrumbs = $this->build_breadcrumbs();

		if ( empty( $breadcrumbs ) ) {
			return array();
		}

		$items = array();
		$position = 1;

		foreach ( $breadcrumbs as $crumb ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $position,
				'name'     => $crumb['name'],
				'item'     => $crumb['url'],
			);
			$position++;
		}

		return array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $items,
		);
	}

	/**
	 * Zbuduj breadcrumbs.
	 */
	private function build_breadcrumbs() {
		$breadcrumbs = array();

		// Strona główna.
		$breadcrumbs[] = array(
			'name' => 'Strona główna',
			'url'  => home_url( '/' ),
		);

		if ( is_page() ) {
			$post = get_queried_object();

			// Jeśli strona ma rodzica.
			if ( $post->post_parent ) {
				$ancestors = get_post_ancestors( $post->ID );
				$ancestors = array_reverse( $ancestors );

				foreach ( $ancestors as $ancestor_id ) {
					$breadcrumbs[] = array(
						'name' => get_the_title( $ancestor_id ),
						'url'  => get_permalink( $ancestor_id ),
					);
				}
			}

			// Aktualna strona.
			$breadcrumbs[] = array(
				'name' => get_the_title(),
				'url'  => get_permalink(),
			);
		} elseif ( is_singular( 'post' ) ) {
			// Kategoria.
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$breadcrumbs[] = array(
					'name' => $categories[0]->name,
					'url'  => get_category_link( $categories[0]->term_id ),
				);
			}

			// Wpis.
			$breadcrumbs[] = array(
				'name' => get_the_title(),
				'url'  => get_permalink(),
			);
		} elseif ( is_category() ) {
			$breadcrumbs[] = array(
				'name' => single_cat_title( '', false ),
				'url'  => get_category_link( get_queried_object_id() ),
			);
		} elseif ( is_search() ) {
			$breadcrumbs[] = array(
				'name' => 'Wyniki wyszukiwania: ' . get_search_query(),
				'url'  => get_search_link(),
			);
		} elseif ( is_404() ) {
			$breadcrumbs[] = array(
				'name' => 'Strona nie znaleziona',
				'url'  => home_url( $_SERVER['REQUEST_URI'] ),
			);
		}

		return $breadcrumbs;
	}

	/**
	 * Wizualna nawigacja breadcrumb w stopce (opcjonalnie).
	 */
	public function output_breadcrumb_schema() {
		// Schema jest już w head, ta funkcja może być użyta do HTML breadcrumbs.
	}
}

// Inicjalizacja.
new Hotel_Nowydwor_Schema_Org();
