<?php
/**
 * Plugin Name: PB MEDIA - Hotel Nowy Dwór Accessibility
 * Description: Usprawnienia dostępności WCAG 2.1 AA: skip links, ARIA landmarks, focus indicators, kontrast, czytniki ekranu.
 * Version: 1.0
 * Author: PB MEDIA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Główna klasa dostępności.
 */
class Hotel_Nowydwor_Accessibility {

	/**
	 * Konstruktor.
	 */
	public function __construct() {
		// Dodaj skip links na początku body.
		add_action( 'wp_body_open', array( $this, 'add_skip_links' ), 1 );

		// Dodaj CSS dla dostępności.
		add_action( 'wp_head', array( $this, 'add_accessibility_css' ), 99 );

		// Dodaj JS dla dostępności.
		add_action( 'wp_footer', array( $this, 'add_accessibility_js' ), 99 );

		// Dodaj ARIA landmarks do nawigacji.
		add_filter( 'nav_menu_item_args', array( $this, 'add_aria_to_menu' ), 10, 3 );

		// Dodaj atrybut lang do html tag.
		add_filter( 'language_attributes', array( $this, 'add_language_attributes' ) );

		// Filtruj obrazki - dodaj role="img" jeśli brak alt.
		add_filter( 'the_content', array( $this, 'fix_image_accessibility' ), 99 );

		// Dodaj focus-visible polyfill.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_focus_visible' ) );

		// Dodaj role="navigation" do widgetów nawigacyjnych.
		add_filter( 'widget_nav_menu_args', array( $this, 'add_nav_widget_aria' ) );

		// Popraw dostępność formularza wyszukiwania.
		add_filter( 'get_search_form', array( $this, 'accessible_search_form' ) );

		// Popraw linki "Czytaj więcej".
		add_filter( 'the_content_more_link', array( $this, 'accessible_more_link' ), 10, 2 );
		add_filter( 'excerpt_more', array( $this, 'accessible_excerpt_more' ) );
	}

	/**
	 * Dodaj skip links.
	 */
	public function add_skip_links() {
		?>
		<nav id="skip-links" class="skip-links" aria-label="<?php esc_attr_e( 'Przejdź do sekcji', 'hotel-nowydwor' ); ?>">
			<a class="skip-link" href="#main-content">
				<?php esc_html_e( 'Przejdź do treści głównej', 'hotel-nowydwor' ); ?>
			</a>
			<a class="skip-link" href="#main-navigation">
				<?php esc_html_e( 'Przejdź do nawigacji', 'hotel-nowydwor' ); ?>
			</a>
			<a class="skip-link" href="#footer">
				<?php esc_html_e( 'Przejdź do stopki', 'hotel-nowydwor' ); ?>
			</a>
		</nav>
		<?php
	}

	/**
	 * CSS dla dostępności.
	 */
	public function add_accessibility_css() {
		?>
		<style id="hotel-nowydwor-accessibility-css">
			/* Skip Links - widoczne tylko przy fokusie */
			.skip-links {
				position: absolute;
				top: 0;
				left: 0;
				z-index: 100000;
				width: 100%;
			}

			.skip-link {
				position: absolute;
				top: -100px;
				left: 50%;
				transform: translateX(-50%);
				padding: 12px 24px;
				background-color: #0a97b0;
				color: #ffffff;
				font-size: 16px;
				font-weight: 600;
				text-decoration: none;
				border-radius: 0 0 8px 8px;
				box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
				transition: top 0.3s ease;
				z-index: 100001;
			}

			.skip-link:focus {
				top: 0;
				outline: 3px solid #000000;
				outline-offset: 2px;
			}

			/* Focus indicators - WCAG 2.1 AA wymaga widocznego focus */
			*:focus {
				outline: 2px solid #0a97b0;
				outline-offset: 2px;
			}

			/* Focus-visible - dla klawiaturowej nawigacji */
			*:focus:not(:focus-visible) {
				outline: none;
			}

			*:focus-visible {
				outline: 3px solid #0a97b0;
				outline-offset: 2px;
			}

			/* Przycisk focus */
			button:focus-visible,
			input[type="submit"]:focus-visible,
			input[type="button"]:focus-visible,
			a.button:focus-visible,
			.btn:focus-visible {
				outline: 3px solid #000000;
				outline-offset: 3px;
				box-shadow: 0 0 0 6px rgba(10, 151, 176, 0.3);
			}

			/* Link focus */
			a:focus-visible {
				outline: 2px solid #0a97b0;
				outline-offset: 2px;
				text-decoration: underline;
			}

			/* Input focus */
			input:focus-visible,
			textarea:focus-visible,
			select:focus-visible {
				outline: 2px solid #0a97b0;
				outline-offset: 1px;
				border-color: #0a97b0;
			}

			/* Screen reader only - tekst tylko dla czytników ekranu */
			.sr-only,
			.screen-reader-text {
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
			.sr-only:focus,
			.screen-reader-text:focus,
			.sr-only-focusable:focus {
				position: relative !important;
				width: auto !important;
				height: auto !important;
				margin: 0 !important;
				overflow: visible !important;
				clip: auto !important;
				white-space: normal !important;
			}

			/* Minimalny rozmiar touch target - 44x44px (WCAG 2.1) */
			button,
			a,
			input[type="submit"],
			input[type="button"],
			input[type="checkbox"],
			input[type="radio"],
			select {
				min-height: 44px;
				min-width: 44px;
			}

			/* Mniejsze elementy z większym paddingiem */
			.menu-item a,
			nav a {
				padding: 10px 12px;
				display: inline-block;
			}

			/* Redukcja ruchu dla użytkowników preferujących */
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

			/* Wysoki kontrast dla elementów hover */
			a:hover {
				text-decoration: underline;
			}

			/* Kontrastowe podświetlenie przy hover */
			button:hover,
			input[type="submit"]:hover,
			.btn:hover {
				opacity: 0.9;
			}

			/* Widoczne stany dla checkbox i radio */
			input[type="checkbox"]:checked,
			input[type="radio"]:checked {
				accent-color: #0a97b0;
			}

			/* Error states - kontrast dla walidacji */
			input.error,
			input:invalid,
			textarea.error,
			textarea:invalid {
				border-color: #dc3545;
				outline-color: #dc3545;
			}

			/* Success states */
			input.success,
			input:valid:not(:placeholder-shown),
			textarea.success,
			textarea:valid:not(:placeholder-shown) {
				border-color: #28a745;
			}

			/* Live region dla powiadomień */
			[aria-live] {
				position: relative;
			}

			/* Zakres selekcji - wysoki kontrast */
			::selection {
				background-color: #0a97b0;
				color: #ffffff;
			}

			/* Mark element - highliting */
			mark {
				background-color: #ffeb3b;
				color: #000000;
				padding: 0.1em 0.2em;
			}

			/* Tabela - responsywność i dostępność */
			table {
				border-collapse: collapse;
			}

			th,
			td {
				padding: 8px 12px;
				text-align: left;
			}

			th {
				background-color: #f5f5f5;
			}

			/* Caption dla tabel */
			caption {
				font-weight: bold;
				text-align: left;
				padding: 8px 0;
			}

			/* Formularz - etykiety */
			label {
				display: block;
				margin-bottom: 4px;
				font-weight: 500;
			}

			/* Required indicator */
			.required,
			[aria-required="true"]::before {
				color: #dc3545;
			}

			/* Error messages */
			.error-message,
			.wpcf7-not-valid-tip {
				color: #dc3545;
				font-size: 0.875rem;
				margin-top: 4px;
			}

			/* Main content landmark */
			#main-content,
			[role="main"],
			main {
				min-height: 50vh;
			}

			/* Dialog/Modal accessibility */
			[role="dialog"],
			[aria-modal="true"] {
				position: fixed;
				z-index: 10000;
			}

			/* Loading state */
			[aria-busy="true"] {
				cursor: wait;
				opacity: 0.7;
			}

			/* Disabled state */
			[aria-disabled="true"],
			[disabled] {
				opacity: 0.5;
				cursor: not-allowed;
			}

			/* Current page in navigation */
			[aria-current="page"] {
				font-weight: bold;
				text-decoration: underline;
			}

			/* Expanded/Collapsed states */
			[aria-expanded="true"]::after {
				content: " ▲";
			}

			[aria-expanded="false"]::after {
				content: " ▼";
			}
		</style>
		<?php
	}

	/**
	 * JavaScript dla dostępności.
	 */
	public function add_accessibility_js() {
		?>
		<script id="hotel-nowydwor-accessibility-js">
		(function() {
			'use strict';

			// Dodaj ID do main content jeśli nie istnieje.
			var mainContent = document.querySelector('main, [role="main"], .main-content, #content, .content');
			if (mainContent && !mainContent.id) {
				mainContent.id = 'main-content';
			}

			// Dodaj ID do nawigacji głównej.
			var mainNav = document.querySelector('nav, .navigation, .main-navigation, #menu, .menu');
			if (mainNav && !mainNav.id) {
				mainNav.id = 'main-navigation';
			}

			// Dodaj ID do stopki.
			var footer = document.querySelector('footer, .footer, #footer');
			if (footer && !footer.id) {
				footer.id = 'footer';
			}

			// Dodaj role="main" jeśli nie istnieje.
			if (mainContent && !mainContent.hasAttribute('role')) {
				mainContent.setAttribute('role', 'main');
			}

			// Dodaj role="navigation" do nav elementów.
			document.querySelectorAll('nav').forEach(function(nav) {
				if (!nav.hasAttribute('role')) {
					nav.setAttribute('role', 'navigation');
				}
				if (!nav.hasAttribute('aria-label')) {
					nav.setAttribute('aria-label', 'Nawigacja strony');
				}
			});

			// Dodaj role="banner" do header.
			var header = document.querySelector('header, .header, #header');
			if (header && !header.hasAttribute('role')) {
				header.setAttribute('role', 'banner');
			}

			// Dodaj role="contentinfo" do footer.
			if (footer && !footer.hasAttribute('role')) {
				footer.setAttribute('role', 'contentinfo');
			}

			// Napraw obrazki bez alt - dodaj aria-hidden.
			document.querySelectorAll('img').forEach(function(img) {
				if (!img.hasAttribute('alt')) {
					img.setAttribute('alt', '');
					// Jeśli obrazek jest dekoracyjny.
					if (!img.closest('a') && !img.closest('button')) {
						img.setAttribute('aria-hidden', 'true');
						img.setAttribute('role', 'presentation');
					}
				}
			});

			// Obsługa klawiatury dla elementów z onclick.
			document.querySelectorAll('[onclick]').forEach(function(el) {
				if (!el.hasAttribute('tabindex')) {
					el.setAttribute('tabindex', '0');
				}
				if (!el.hasAttribute('role')) {
					el.setAttribute('role', 'button');
				}

				// Dodaj obsługę Enter i Space.
				el.addEventListener('keydown', function(e) {
					if (e.key === 'Enter' || e.key === ' ') {
						e.preventDefault();
						el.click();
					}
				});
			});

			// Zewnętrzne linki - dodaj ostrzeżenie dla czytników ekranu.
			document.querySelectorAll('a[target="_blank"]').forEach(function(link) {
				if (!link.querySelector('.sr-only') && !link.getAttribute('aria-label')) {
					var srText = document.createElement('span');
					srText.className = 'sr-only';
					srText.textContent = ' (otwiera się w nowym oknie)';
					link.appendChild(srText);

					// Dodaj rel="noopener" dla bezpieczeństwa.
					var rel = link.getAttribute('rel') || '';
					if (rel.indexOf('noopener') === -1) {
						link.setAttribute('rel', rel + ' noopener');
					}
				}
			});

			// Popraw tabele - dodaj scope do nagłówków.
			document.querySelectorAll('table').forEach(function(table) {
				// Dodaj role jeśli brak.
				if (!table.hasAttribute('role')) {
					table.setAttribute('role', 'table');
				}

				// Dodaj scope do th.
				table.querySelectorAll('th').forEach(function(th) {
					if (!th.hasAttribute('scope')) {
						// Sprawdź czy to nagłówek wiersza czy kolumny.
						var isRowHeader = th.parentNode.querySelector('td');
						th.setAttribute('scope', isRowHeader ? 'row' : 'col');
					}
				});
			});

			// Trap focus w modal/dialog.
			function trapFocus(element) {
				var focusableElements = element.querySelectorAll(
					'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
				);
				var firstFocusable = focusableElements[0];
				var lastFocusable = focusableElements[focusableElements.length - 1];

				element.addEventListener('keydown', function(e) {
					if (e.key === 'Tab') {
						if (e.shiftKey) {
							if (document.activeElement === firstFocusable) {
								lastFocusable.focus();
								e.preventDefault();
							}
						} else {
							if (document.activeElement === lastFocusable) {
								firstFocusable.focus();
								e.preventDefault();
							}
						}
					}
					if (e.key === 'Escape') {
						// Zamknij modal przy Escape.
						var closeButton = element.querySelector('[data-dismiss], .close, .modal-close');
						if (closeButton) {
							closeButton.click();
						}
					}
				});
			}

			// Aktywuj trap focus dla modali.
			document.querySelectorAll('[role="dialog"], [aria-modal="true"], .modal').forEach(trapFocus);

			// Live region dla dynamicznych powiadomień.
			var liveRegion = document.querySelector('[aria-live]');
			if (!liveRegion) {
				liveRegion = document.createElement('div');
				liveRegion.setAttribute('aria-live', 'polite');
				liveRegion.setAttribute('aria-atomic', 'true');
				liveRegion.className = 'sr-only';
				liveRegion.id = 'live-region';
				document.body.appendChild(liveRegion);
			}

			// Funkcja do ogłaszania zmian.
			window.announceToScreenReader = function(message) {
				var region = document.getElementById('live-region');
				if (region) {
					region.textContent = '';
					setTimeout(function() {
						region.textContent = message;
					}, 100);
				}
			};

			// Obsługa smooth scroll z respektowaniem prefers-reduced-motion.
			if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
				document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
					anchor.addEventListener('click', function(e) {
						var target = document.querySelector(this.getAttribute('href'));
						if (target) {
							e.preventDefault();
							target.scrollIntoView({ behavior: 'smooth', block: 'start' });
							target.focus();
						}
					});
				});
			}

			// Dodaj aria-current="page" do aktualnej strony w menu.
			var currentUrl = window.location.href.replace(/\/$/, '');
			document.querySelectorAll('nav a, .menu a').forEach(function(link) {
				var linkUrl = link.href.replace(/\/$/, '');
				if (linkUrl === currentUrl) {
					link.setAttribute('aria-current', 'page');
				}
			});

		})();
		</script>
		<?php
	}

	/**
	 * Dodaj ARIA do menu items.
	 */
	public function add_aria_to_menu( $args, $item, $depth ) {
		// Dodaj aria-current dla aktualnej strony.
		if ( in_array( 'current-menu-item', $item->classes, true ) ) {
			$args->link_attributes = isset( $args->link_attributes ) ? $args->link_attributes : '';
			$args->link_attributes .= ' aria-current="page"';
		}

		return $args;
	}

	/**
	 * Dodaj atrybuty językowe.
	 */
	public function add_language_attributes( $output ) {
		// Upewnij się, że lang jest ustawiony.
		if ( strpos( $output, 'lang=' ) === false ) {
			$output .= ' lang="pl"';
		}

		// Dodaj dir dla kierunku tekstu.
		if ( strpos( $output, 'dir=' ) === false ) {
			$output .= ' dir="ltr"';
		}

		return $output;
	}

	/**
	 * Napraw dostępność obrazków w treści.
	 */
	public function fix_image_accessibility( $content ) {
		// Dodaj role="img" do figur z obrazkami.
		$content = preg_replace(
			'/<figure([^>]*)class="([^"]*)"([^>]*)>/i',
			'<figure$1class="$2" role="figure"$3>',
			$content
		);

		// Upewnij się, że każdy obrazek ma alt (nawet pusty).
		$content = preg_replace_callback(
			'/<img([^>]*?)(\s*\/?>)/i',
			function( $matches ) {
				$attrs = $matches[1];

				// Sprawdź czy alt istnieje.
				if ( strpos( $attrs, 'alt=' ) === false ) {
					// Dodaj pusty alt.
					$attrs .= ' alt=""';
				}

				return '<img' . $attrs . $matches[2];
			},
			$content
		);

		return $content;
	}

	/**
	 * Focus visible polyfill.
	 */
	public function enqueue_focus_visible() {
		// Focus-visible polyfill dla starszych przeglądarek.
		// Opcjonalnie - możesz załadować z CDN.
		wp_enqueue_script( 'focus-visible', 'https://unpkg.com/focus-visible@5.2.0/dist/focus-visible.min.js', array(), '5.2.0', true );
	}

	/**
	 * Dodaj ARIA do widgetu nawigacji.
	 */
	public function add_nav_widget_aria( $args ) {
		if ( ! isset( $args['container_aria_label'] ) ) {
			$args['container_aria_label'] = 'Nawigacja widgetu';
		}
		return $args;
	}

	/**
	 * Dostępny formularz wyszukiwania.
	 */
	public function accessible_search_form( $form ) {
		// Dodaj aria-label jeśli brak.
		if ( strpos( $form, 'aria-label' ) === false ) {
			$form = str_replace(
				'<form',
				'<form role="search" aria-label="Wyszukiwanie w serwisie"',
				$form
			);
		}

		// Dodaj powiązanie label z input.
		$search_id = 'search-field-' . wp_rand();
		$form = str_replace( 'id="s"', 'id="' . $search_id . '"', $form );

		// Dodaj label jeśli brak.
		if ( strpos( $form, '<label' ) === false ) {
			$label = '<label for="' . $search_id . '" class="sr-only">Szukaj:</label>';
			$form = str_replace( '<input', $label . '<input', $form );
		}

		return $form;
	}

	/**
	 * Dostępny link "Czytaj więcej".
	 */
	public function accessible_more_link( $link, $more_link_text ) {
		// Dodaj kontekst dla czytników ekranu.
		$title = get_the_title();
		$sr_text = '<span class="sr-only">: ' . esc_html( $title ) . '</span>';

		return str_replace( '</a>', $sr_text . '</a>', $link );
	}

	/**
	 * Dostępny excerpt more.
	 */
	public function accessible_excerpt_more( $more ) {
		$title = get_the_title();
		return '... <a href="' . esc_url( get_permalink() ) . '" aria-label="Czytaj więcej o: ' . esc_attr( $title ) . '">Czytaj więcej<span class="sr-only">: ' . esc_html( $title ) . '</span></a>';
	}
}

// Inicjalizacja.
new Hotel_Nowydwor_Accessibility();

/**
 * Dodaj wsparcie dla wp_body_open hook (dla starszych motywów).
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Fallback dla wp_body_open.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
