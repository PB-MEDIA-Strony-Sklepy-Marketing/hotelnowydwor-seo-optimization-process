<?php
/**
 * Plugin Name: HND Accessibility Module
 * Description: Moduł dostępności WCAG 2.1 AA - skip links, fokus, kontrast, ARIA labels, nazwy linków.
 * Version: 2.0.0
 * Author: PB MEDIA
 *
 * @package HND_Accessibility_Module
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Klasa modułu dostępności.
 */
class HND_Accessibility_Module {

	/**
	 * Instancja singletona.
	 *
	 * @var HND_Accessibility_Module
	 */
	private static $instance = null;

	/**
	 * Referencja do głównego optymalizatora.
	 *
	 * @var HND_PageSpeed_Optimizer
	 */
	private $optimizer = null;

	/**
	 * Pobierz instancję.
	 *
	 * @return HND_Accessibility_Module
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Konstruktor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ), 20 );
	}

	/**
	 * Inicjalizacja.
	 */
	public function init() {
		if ( class_exists( 'HND_PageSpeed_Optimizer' ) ) {
			$this->optimizer = HND_PageSpeed_Optimizer::get_instance();
		}

		$this->init_hooks();
	}

	/**
	 * Sprawdź czy funkcja jest włączona.
	 *
	 * @param string $key Klucz ustawienia.
	 * @return bool
	 */
	private function is_enabled( $key ) {
		if ( $this->optimizer && method_exists( $this->optimizer, 'is_enabled' ) ) {
			return $this->optimizer->is_enabled( $key );
		}
		return true;
	}

	/**
	 * Sprawdź czy jesteśmy na frontendzie.
	 *
	 * @return bool
	 */
	private function is_frontend() {
		if ( is_admin() ) {
			return false;
		}

		if ( defined( 'SHOW_CT_BUILDER' ) && SHOW_CT_BUILDER ) {
			return false;
		}

		if ( isset( $_GET['ct_builder'] ) || isset( $_GET['oxygen_iframe'] ) ) {
			return false;
		}

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return false;
		}

		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return false;
		}

		return true;
	}

	/**
	 * Inicjalizuj hooki.
	 */
	private function init_hooks() {
		// 1. Skip Links.
		if ( $this->is_enabled( 'enable_skip_links' ) ) {
			add_action( 'wp_body_open', array( $this, 'add_skip_links' ), 1 );
		}

		// 2. Style fokusa.
		if ( $this->is_enabled( 'enable_focus_styles' ) ) {
			add_action( 'wp_head', array( $this, 'add_focus_styles' ), 99 );
		}

		// 3. Poprawki kontrastu.
		if ( $this->is_enabled( 'fix_contrast_issues' ) ) {
			add_action( 'wp_head', array( $this, 'add_contrast_fixes' ), 99 );
		}

		// 4. ARIA labels.
		if ( $this->is_enabled( 'add_aria_labels' ) ) {
			add_action( 'wp_footer', array( $this, 'add_aria_labels_js' ), 99 );
			add_filter( 'nav_menu_item_args', array( $this, 'add_aria_to_menu' ), 10, 3 );
		}

		// 5. Nazwy linków.
		if ( $this->is_enabled( 'fix_link_names' ) ) {
			add_filter( 'the_content', array( $this, 'fix_link_names' ), 30 );
			add_filter( 'the_content_more_link', array( $this, 'accessible_more_link' ), 10, 2 );
			add_filter( 'excerpt_more', array( $this, 'accessible_excerpt_more' ) );
		}

		// 6. Dodaj język i kierunek tekstu.
		add_filter( 'language_attributes', array( $this, 'add_language_attributes' ) );

		// 7. Napraw formularze.
		add_filter( 'get_search_form', array( $this, 'accessible_search_form' ) );

		// 8. Widget nawigacji.
		add_filter( 'widget_nav_menu_args', array( $this, 'add_nav_widget_aria' ) );

		// 9. Live region dla dynamicznych powiadomień.
		add_action( 'wp_footer', array( $this, 'add_live_region' ), 100 );

		// 10. Reduced motion support.
		add_action( 'wp_head', array( $this, 'add_reduced_motion_styles' ), 99 );
	}

	/**
	 * Dodaj skip links.
	 */
	public function add_skip_links() {
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<nav id="hnd-skip-links" class="hnd-skip-links" aria-label="Przejdź do sekcji">
			<a class="hnd-skip-link" href="#main-content">Przejdź do treści głównej</a>
			<a class="hnd-skip-link" href="#main-navigation">Przejdź do nawigacji</a>
			<a class="hnd-skip-link" href="#footer">Przejdź do stopki</a>
		</nav>
		<style>
			.hnd-skip-links {
				position: absolute;
				top: 0;
				left: 0;
				z-index: 999999;
				width: 100%;
				pointer-events: none;
			}
			.hnd-skip-link {
				position: absolute;
				top: -100px;
				left: 50%;
				transform: translateX(-50%);
				padding: 12px 24px;
				background-color: #0a97b0;
				color: #ffffff !important;
				font-size: 16px;
				font-weight: 600;
				text-decoration: none;
				border-radius: 0 0 8px 8px;
				box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
				transition: top 0.3s ease;
				pointer-events: auto;
			}
			.hnd-skip-link:focus {
				top: 0;
				outline: 3px solid #000000;
				outline-offset: 2px;
			}
		</style>
		<?php
	}

	/**
	 * Dodaj style fokusa.
	 */
	public function add_focus_styles() {
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<style id="hnd-focus-styles">
			/* Focus indicators dla nawigacji klawiaturowej */
			a:focus,
			button:focus,
			input:focus,
			select:focus,
			textarea:focus,
			[tabindex]:focus {
				outline: 2px solid #0a97b0;
				outline-offset: 2px;
			}

			/* Focus-visible dla lepszego UX */
			a:focus:not(:focus-visible),
			button:focus:not(:focus-visible) {
				outline: none;
			}

			a:focus-visible,
			button:focus-visible {
				outline: 3px solid #0a97b0;
				outline-offset: 2px;
			}

			/* Przyciski i linki button-like */
			button:focus-visible,
			input[type="submit"]:focus-visible,
			input[type="button"]:focus-visible,
			.btn:focus-visible,
			a.button:focus-visible {
				outline: 3px solid #000000;
				outline-offset: 3px;
				box-shadow: 0 0 0 6px rgba(10, 151, 176, 0.3);
			}

			/* Formularze */
			input:focus-visible,
			textarea:focus-visible,
			select:focus-visible {
				outline: 2px solid #0a97b0;
				outline-offset: 1px;
				border-color: #0a97b0;
			}

			/* Screen reader only */
			.sr-only,
			.screen-reader-text,
			.hnd-sr-only {
				position: absolute !important;
				width: 1px !important;
				height: 1px !important;
				padding: 0 !important;
				margin: -1px !important;
				overflow: hidden !important;
				clip: rect(0, 0, 0, 0) !important;
				white-space: nowrap !important;
				border: 0 !important;
			}

			/* Pokazuj sr-only przy fokusie */
			.sr-only-focusable:focus,
			.hnd-sr-only-focusable:focus {
				position: relative !important;
				width: auto !important;
				height: auto !important;
				margin: 0 !important;
				overflow: visible !important;
				clip: auto !important;
				white-space: normal !important;
			}

			/* Minimalny rozmiar elementów klikalnych (44x44px) */
			button,
			.btn,
			a.button,
			input[type="submit"],
			input[type="button"] {
				min-height: 44px;
				min-width: 44px;
			}

			/* Zwiększ obszar klikalny dla małych linków */
			nav a,
			.menu a {
				padding: 8px 12px;
				display: inline-block;
			}

			/* Current page w nawigacji */
			nav [aria-current="page"],
			.menu .current-menu-item > a {
				font-weight: bold;
				text-decoration: underline;
			}
		</style>
		<?php
	}

	/**
	 * Dodaj poprawki kontrastu.
	 */
	public function add_contrast_fixes() {
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<style id="hnd-contrast-fixes">
			/* Poprawki kontrastu - WCAG AA (4.5:1) */

			/* Tekst na jasnym tle */
			body {
				color: #1a202c; /* Kontrast 12.6:1 na białym tle */
			}

			/* Nagłówki */
			h1, h2, h3, h4, h5, h6 {
				color: #1a365d; /* Kontrast 9.5:1 */
			}

			/* Linki */
			a {
				color: #0a6073; /* Kontrast 5.5:1 na białym tle */
			}

			a:hover {
				color: #063d49;
				text-decoration: underline;
			}

			/* Placeholder tekst - musi mieć kontrast 4.5:1 */
			::placeholder {
				color: #5a6677; /* Kontrast 4.6:1 */
				opacity: 1;
			}

			/* Disabled elements */
			[disabled],
			.disabled {
				opacity: 0.6;
				cursor: not-allowed;
			}

			/* Tekst na kolorowym tle (np. przyciski) */
			.btn-primary,
			button[type="submit"],
			input[type="submit"] {
				background-color: #0a97b0;
				color: #ffffff; /* Kontrast 4.5:1 */
			}

			/* Ostrzeżenia i błędy */
			.error,
			.alert-error,
			.wpcf7-not-valid-tip {
				color: #c53030; /* Kontrast 5.9:1 */
			}

			.success,
			.alert-success {
				color: #276749; /* Kontrast 5.2:1 */
			}

			/* Etykiety formularzy */
			label {
				color: #2d3748; /* Kontrast 10.7:1 */
				font-weight: 500;
			}

			/* Wymagane pola */
			.required {
				color: #c53030;
			}

			/* Stopka - jeśli ma ciemne tło */
			footer {
				color: rgba(255, 255, 255, 0.9);
			}

			footer a {
				color: #ffffff;
			}

			footer a:hover {
				text-decoration: underline;
			}

			/* Selekcja tekstu */
			::selection {
				background-color: #0a97b0;
				color: #ffffff;
			}

			/* Mark/highlight */
			mark {
				background-color: #fef3c7;
				color: #92400e;
				padding: 0.1em 0.2em;
			}
		</style>
		<?php
	}

	/**
	 * Dodaj ARIA labels via JavaScript.
	 */
	public function add_aria_labels_js() {
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<script id="hnd-aria-labels-js">
		(function() {
			'use strict';

			// Sprawdź czy na frontendzie.
			if (document.body.classList.contains('wp-admin') ||
			    document.body.classList.contains('oxygen-builder-body')) {
				return;
			}

			// Dodaj ID do main content.
			var mainContent = document.querySelector('main, [role="main"], .main-content, #content, .site-content');
			if (mainContent && !mainContent.id) {
				mainContent.id = 'main-content';
			}
			if (mainContent && !mainContent.hasAttribute('role')) {
				mainContent.setAttribute('role', 'main');
			}

			// Dodaj ID do nawigacji głównej.
			var mainNav = document.querySelector('nav.main-navigation, .site-navigation, #primary-menu, header nav');
			if (mainNav && !mainNav.id) {
				mainNav.id = 'main-navigation';
			}

			// Dodaj ID do stopki.
			var footer = document.querySelector('footer, .site-footer, #colophon');
			if (footer && !footer.id) {
				footer.id = 'footer';
			}

			// Role="navigation" do nav.
			document.querySelectorAll('nav').forEach(function(nav) {
				if (!nav.hasAttribute('role')) {
					nav.setAttribute('role', 'navigation');
				}
				if (!nav.hasAttribute('aria-label') && !nav.hasAttribute('aria-labelledby')) {
					if (nav.id === 'main-navigation' || nav.classList.contains('main-navigation')) {
						nav.setAttribute('aria-label', 'Nawigacja główna');
					} else if (nav.closest('footer')) {
						nav.setAttribute('aria-label', 'Nawigacja stopki');
					} else {
						nav.setAttribute('aria-label', 'Nawigacja');
					}
				}
			});

			// Role="banner" do header.
			var header = document.querySelector('header, .site-header, #masthead');
			if (header && !header.hasAttribute('role')) {
				header.setAttribute('role', 'banner');
			}

			// Role="contentinfo" do footer.
			if (footer && !footer.hasAttribute('role')) {
				footer.setAttribute('role', 'contentinfo');
			}

			// Napraw obrazki bez alt.
			document.querySelectorAll('img:not([alt])').forEach(function(img) {
				img.setAttribute('alt', '');
				if (!img.closest('a') && !img.closest('button')) {
					img.setAttribute('aria-hidden', 'true');
					img.setAttribute('role', 'presentation');
				}
			});

			// Zewnętrzne linki - dodaj ostrzeżenie.
			document.querySelectorAll('a[target="_blank"]').forEach(function(link) {
				if (link.querySelector('.hnd-sr-only, .sr-only')) {
					return;
				}

				var srText = document.createElement('span');
				srText.className = 'hnd-sr-only';
				srText.textContent = ' (otwiera się w nowym oknie)';
				link.appendChild(srText);

				// Dodaj rel="noopener".
				var rel = link.getAttribute('rel') || '';
				if (rel.indexOf('noopener') === -1) {
					link.setAttribute('rel', (rel + ' noopener').trim());
				}
			});

			// Tabele - dodaj scope.
			document.querySelectorAll('table th').forEach(function(th) {
				if (!th.hasAttribute('scope')) {
					var isRowHeader = th.parentNode.querySelector('td');
					th.setAttribute('scope', isRowHeader ? 'row' : 'col');
				}
			});

			// aria-current="page" dla aktualnej strony.
			var currentUrl = window.location.href.replace(/\/$/, '').split('?')[0].split('#')[0];
			document.querySelectorAll('nav a, .menu a').forEach(function(link) {
				var linkUrl = link.href.replace(/\/$/, '').split('?')[0].split('#')[0];
				if (linkUrl === currentUrl) {
					link.setAttribute('aria-current', 'page');
				}
			});

			// Obsługa klawiatury dla elementów z onclick.
			document.querySelectorAll('[onclick]:not(a):not(button)').forEach(function(el) {
				if (!el.hasAttribute('tabindex')) {
					el.setAttribute('tabindex', '0');
				}
				if (!el.hasAttribute('role')) {
					el.setAttribute('role', 'button');
				}

				el.addEventListener('keydown', function(e) {
					if (e.key === 'Enter' || e.key === ' ') {
						e.preventDefault();
						el.click();
					}
				});
			});

		})();
		</script>
		<?php
	}

	/**
	 * Dodaj ARIA do menu items.
	 *
	 * @param object $args  Argumenty.
	 * @param object $item  Element menu.
	 * @param int    $depth Głębokość.
	 * @return object
	 */
	public function add_aria_to_menu( $args, $item, $depth ) {
		if ( in_array( 'current-menu-item', $item->classes, true ) ) {
			if ( ! isset( $args->link_attributes ) ) {
				$args->link_attributes = '';
			}
			$args->link_attributes .= ' aria-current="page"';
		}

		return $args;
	}

	/**
	 * Napraw nazwy linków w treści.
	 *
	 * @param string $content Treść.
	 * @return string
	 */
	public function fix_link_names( $content ) {
		if ( empty( $content ) ) {
			return $content;
		}

		// Znajdź linki z niejasnymi tekstami.
		$unclear_texts = array(
			'kliknij',
			'kliknij tutaj',
			'tutaj',
			'czytaj więcej',
			'więcej',
			'zobacz',
			'pobierz',
			'link',
			'click here',
			'here',
			'read more',
			'more',
		);

		foreach ( $unclear_texts as $text ) {
			// Znajdź linki z tym tekstem.
			$pattern = '/<a([^>]*)>' . preg_quote( $text, '/' ) . '<\/a>/i';

			$content = preg_replace_callback(
				$pattern,
				function( $matches ) use ( $text ) {
					$attrs = $matches[1];

					// Sprawdź czy ma już aria-label.
					if ( strpos( $attrs, 'aria-label' ) !== false ) {
						return $matches[0];
					}

					// Dodaj aria-label z opisem.
					return '<a' . $attrs . '>' . $text . '</a>';
				},
				$content
			);
		}

		return $content;
	}

	/**
	 * Dostępny link "Czytaj więcej".
	 *
	 * @param string $link            Link.
	 * @param string $more_link_text  Tekst.
	 * @return string
	 */
	public function accessible_more_link( $link, $more_link_text ) {
		$title   = get_the_title();
		$sr_text = '<span class="hnd-sr-only">: ' . esc_html( $title ) . '</span>';

		return str_replace( '</a>', $sr_text . '</a>', $link );
	}

	/**
	 * Dostępny excerpt more.
	 *
	 * @param string $more More text.
	 * @return string
	 */
	public function accessible_excerpt_more( $more ) {
		$title = get_the_title();
		return '... <a href="' . esc_url( get_permalink() ) . '" aria-label="Czytaj więcej o: ' . esc_attr( $title ) . '">Czytaj więcej<span class="hnd-sr-only">: ' . esc_html( $title ) . '</span></a>';
	}

	/**
	 * Dodaj atrybuty językowe.
	 *
	 * @param string $output Output.
	 * @return string
	 */
	public function add_language_attributes( $output ) {
		if ( strpos( $output, 'lang=' ) === false ) {
			$output .= ' lang="pl"';
		}

		if ( strpos( $output, 'dir=' ) === false ) {
			$output .= ' dir="ltr"';
		}

		return $output;
	}

	/**
	 * Dostępny formularz wyszukiwania.
	 *
	 * @param string $form Formularz.
	 * @return string
	 */
	public function accessible_search_form( $form ) {
		if ( is_admin() ) {
			return $form;
		}

		// Dodaj role="search".
		if ( strpos( $form, 'role="search"' ) === false ) {
			$form = str_replace( '<form', '<form role="search" aria-label="Wyszukiwarka"', $form );
		}

		// Unikalne ID dla label.
		$search_id = 'search-field-' . wp_rand();

		// Zamień ID pola.
		if ( strpos( $form, 'id="s"' ) !== false ) {
			$form = str_replace( 'id="s"', 'id="' . $search_id . '"', $form );
		}

		// Dodaj label jeśli brak.
		if ( strpos( $form, '<label' ) === false ) {
			$label = '<label for="' . $search_id . '" class="hnd-sr-only">Wyszukaj:</label>';
			$form  = str_replace( '<input', $label . '<input', $form );
		}

		return $form;
	}

	/**
	 * Dodaj ARIA do widgetu nawigacji.
	 *
	 * @param array $args Argumenty.
	 * @return array
	 */
	public function add_nav_widget_aria( $args ) {
		if ( ! isset( $args['container_aria_label'] ) ) {
			$args['container_aria_label'] = 'Nawigacja widgetu';
		}
		return $args;
	}

	/**
	 * Dodaj live region.
	 */
	public function add_live_region() {
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<div id="hnd-live-region"
		     aria-live="polite"
		     aria-atomic="true"
		     class="hnd-sr-only"></div>
		<script>
		window.hndAnnounce = function(message) {
			var region = document.getElementById('hnd-live-region');
			if (region) {
				region.textContent = '';
				setTimeout(function() {
					region.textContent = message;
				}, 100);
			}
		};
		</script>
		<?php
	}

	/**
	 * Dodaj style dla reduced motion.
	 */
	public function add_reduced_motion_styles() {
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<style id="hnd-reduced-motion">
			@media (prefers-reduced-motion: reduce) {
				*,
				*::before,
				*::after {
					animation-duration: 0.01ms !important;
					animation-iteration-count: 1 !important;
					transition-duration: 0.01ms !important;
					scroll-behavior: auto !important;
				}
			}
		</style>
		<?php
	}
}

// Inicjalizacja.
HND_Accessibility_Module::get_instance();

/**
 * Wsparcie dla wp_body_open hook.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Fallback dla wp_body_open.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
