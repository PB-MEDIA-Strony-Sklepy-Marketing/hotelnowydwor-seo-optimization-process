<?php
/**
 * Plugin Name: PB MEDIA - Hotel Nowy Dwór Accessibility
 * Description: Usprawnienia dostępności WCAG 2.1 AA - tylko frontend. Bezpieczne dla panelu admina i Oxygen Builder.
 * Version: 1.2
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
		// Dodaj skip links na początku body (tylko frontend).
		add_action( 'wp_body_open', array( $this, 'add_skip_links' ), 1 );

		// Dodaj CSS dla dostępności (tylko frontend).
		add_action( 'wp_head', array( $this, 'add_accessibility_css' ), 99 );

		// Dodaj JS dla dostępności (tylko frontend).
		add_action( 'wp_footer', array( $this, 'add_accessibility_js' ), 99 );

		// Dodaj ARIA do menu items.
		add_filter( 'nav_menu_item_args', array( $this, 'add_aria_to_menu' ), 10, 3 );

		// Dodaj atrybuty językowe.
		add_filter( 'language_attributes', array( $this, 'add_language_attributes' ) );

		// Napraw dostępność obrazków w treści (tylko frontend).
		add_filter( 'the_content', array( $this, 'fix_image_accessibility' ), 99 );

		// Dodaj focus-visible polyfill (tylko frontend).
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
	 * Sprawdź czy jesteśmy na frontendzie (nie w adminie, nie w edytorze Oxygen).
	 */
	private function is_frontend() {
		// Wyklucz panel admina
		if ( is_admin() ) {
			return false;
		}

		// Wyklucz edytor Oxygen Builder
		if ( defined( 'SHOW_CT_BUILDER' ) && SHOW_CT_BUILDER ) {
			return false;
		}

		// Wyklucz iframe edytora Oxygen
		if ( isset( $_GET['ct_builder'] ) || isset( $_GET['oxygen_iframe'] ) ) {
			return false;
		}

		// Wyklucz AJAX requests
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return false;
		}

		// Wyklucz REST API
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return false;
		}

		// Wyklucz customizer
		if ( is_customize_preview() ) {
			return false;
		}

		return true;
	}

	/**
	 * Dodaj skip links.
	 */
	public function add_skip_links() {
		// Tylko na frontendzie
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<nav id="skip-links" class="hnd-skip-links" aria-label="<?php esc_attr_e( 'Przejdź do sekcji', 'hotel-nowydwor' ); ?>">
			<a class="hnd-skip-link" href="#main-content">
				<?php esc_html_e( 'Przejdź do treści głównej', 'hotel-nowydwor' ); ?>
			</a>
			<a class="hnd-skip-link" href="#main-navigation">
				<?php esc_html_e( 'Przejdź do nawigacji', 'hotel-nowydwor' ); ?>
			</a>
			<a class="hnd-skip-link" href="#footer">
				<?php esc_html_e( 'Przejdź do stopki', 'hotel-nowydwor' ); ?>
			</a>
		</nav>
		<?php
	}

	/**
	 * CSS dla dostępności - TYLKO FRONTEND z prefixowanymi klasami.
	 */
	public function add_accessibility_css() {
		// Tylko na frontendzie
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<style id="hotel-nowydwor-accessibility-css">
			/* ============================================
			   HOTEL NOWY DWÓR - ACCESSIBILITY STYLES
			   Prefix: .hnd- (Hotel Nowy Dwór)
			   Scope: Frontend only, excludes admin/Oxygen
			   ============================================ */

			/* Skip Links - widoczne tylko przy fokusie */
			.hnd-skip-links {
				position: absolute;
				top: 0;
				left: 0;
				z-index: 99999;
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
				color: #ffffff;
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

			/* Focus indicators - TYLKO dla elementów na stronie (nie w adminie) */
			body:not(.wp-admin) main a:focus,
			body:not(.wp-admin) main button:focus,
			body:not(.wp-admin) main input:focus,
			body:not(.wp-admin) main select:focus,
			body:not(.wp-admin) main textarea:focus,
			body:not(.wp-admin) header a:focus,
			body:not(.wp-admin) footer a:focus,
			body:not(.wp-admin) nav a:focus {
				outline: 2px solid #0a97b0;
				outline-offset: 2px;
			}

			/* Focus-visible - dla nawigacji klawiaturowej */
			body:not(.wp-admin) main a:focus:not(:focus-visible),
			body:not(.wp-admin) main button:focus:not(:focus-visible),
			body:not(.wp-admin) header a:focus:not(:focus-visible),
			body:not(.wp-admin) footer a:focus:not(:focus-visible) {
				outline: none;
			}

			body:not(.wp-admin) main a:focus-visible,
			body:not(.wp-admin) main button:focus-visible,
			body:not(.wp-admin) header a:focus-visible,
			body:not(.wp-admin) footer a:focus-visible {
				outline: 3px solid #0a97b0;
				outline-offset: 2px;
			}

			/* Przycisk focus - TYLKO w main content */
			body:not(.wp-admin) main button:focus-visible,
			body:not(.wp-admin) main input[type="submit"]:focus-visible,
			body:not(.wp-admin) main input[type="button"]:focus-visible,
			body:not(.wp-admin) main a.button:focus-visible,
			body:not(.wp-admin) main .btn:focus-visible {
				outline: 3px solid #000000;
				outline-offset: 3px;
				box-shadow: 0 0 0 6px rgba(10, 151, 176, 0.3);
			}

			/* Link focus */
			body:not(.wp-admin) main a:focus-visible {
				text-decoration: underline;
			}

			/* Input focus */
			body:not(.wp-admin) main input:focus-visible,
			body:not(.wp-admin) main textarea:focus-visible,
			body:not(.wp-admin) main select:focus-visible {
				outline: 2px solid #0a97b0;
				outline-offset: 1px;
				border-color: #0a97b0;
			}

			/* Screen reader only - tekst tylko dla czytników ekranu */
			.hnd-sr-only,
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
			.hnd-sr-only:focus,
			.screen-reader-text:focus,
			.hnd-sr-only-focusable:focus {
				position: relative !important;
				width: auto !important;
				height: auto !important;
				margin: 0 !important;
				overflow: visible !important;
				clip: auto !important;
				white-space: normal !important;
			}

			/* Minimalny rozmiar touch target - TYLKO dla głównej treści strony */
			body:not(.wp-admin) main button,
			body:not(.wp-admin) main .btn,
			body:not(.wp-admin) main a.button,
			body:not(.wp-admin) main input[type="submit"],
			body:not(.wp-admin) main input[type="button"] {
				min-height: 44px;
				min-width: 44px;
			}

			/* Mniejsze elementy z większym paddingiem - TYLKO nawigacja frontendu */
			body:not(.wp-admin) .site-navigation .menu-item a,
			body:not(.wp-admin) .main-navigation .menu-item a,
			body:not(.wp-admin) #main-navigation a {
				padding: 10px 12px;
				display: inline-block;
			}

			/* Redukcja ruchu dla użytkowników preferujących */
			@media (prefers-reduced-motion: reduce) {
				body:not(.wp-admin) *,
				body:not(.wp-admin) *::before,
				body:not(.wp-admin) *::after {
					animation-duration: 0.01ms !important;
					animation-iteration-count: 1 !important;
					transition-duration: 0.01ms !important;
					scroll-behavior: auto !important;
				}
			}

			/* Wysoki kontrast dla elementów hover - TYLKO frontend */
			body:not(.wp-admin) main a:hover,
			body:not(.wp-admin) header a:hover,
			body:not(.wp-admin) footer a:hover {
				text-decoration: underline;
			}

			/* Widoczne stany dla checkbox i radio - TYLKO w formularzach frontendu */
			body:not(.wp-admin) main input[type="checkbox"]:checked,
			body:not(.wp-admin) main input[type="radio"]:checked {
				accent-color: #0a97b0;
			}

			/* Error states - kontrast dla walidacji */
			body:not(.wp-admin) main input.error,
			body:not(.wp-admin) main input:invalid:not(:placeholder-shown),
			body:not(.wp-admin) main textarea.error,
			body:not(.wp-admin) main textarea:invalid:not(:placeholder-shown) {
				border-color: #dc3545;
				outline-color: #dc3545;
			}

			/* Zakres selekcji - wysoki kontrast */
			body:not(.wp-admin)::selection {
				background-color: #0a97b0;
				color: #ffffff;
			}

			/* Mark element - highlighting */
			body:not(.wp-admin) mark {
				background-color: #ffeb3b;
				color: #000000;
				padding: 0.1em 0.2em;
			}

			/* Tabela - responsywność i dostępność */
			body:not(.wp-admin) main table {
				border-collapse: collapse;
			}

			body:not(.wp-admin) main th,
			body:not(.wp-admin) main td {
				padding: 8px 12px;
				text-align: left;
			}

			body:not(.wp-admin) main th {
				background-color: #f5f5f5;
			}

			/* Caption dla tabel */
			body:not(.wp-admin) main caption {
				font-weight: bold;
				text-align: left;
				padding: 8px 0;
			}

			/* Formularz - etykiety */
			body:not(.wp-admin) main label {
				display: block;
				margin-bottom: 4px;
				font-weight: 500;
			}

			/* Required indicator */
			body:not(.wp-admin) main .required {
				color: #dc3545;
			}

			/* Error messages */
			body:not(.wp-admin) main .error-message,
			body:not(.wp-admin) main .wpcf7-not-valid-tip {
				color: #dc3545;
				font-size: 0.875rem;
				margin-top: 4px;
			}

			/* Main content landmark */
			body:not(.wp-admin) #main-content,
			body:not(.wp-admin) [role="main"],
			body:not(.wp-admin) main {
				min-height: 50vh;
			}

			/* Loading state */
			body:not(.wp-admin) [aria-busy="true"] {
				cursor: wait;
				opacity: 0.7;
			}

			/* Disabled state */
			body:not(.wp-admin) main [aria-disabled="true"],
			body:not(.wp-admin) main [disabled] {
				opacity: 0.5;
				cursor: not-allowed;
			}

			/* Current page in navigation */
			body:not(.wp-admin) nav [aria-current="page"] {
				font-weight: bold;
				text-decoration: underline;
			}
		</style>
		<?php
	}

	/**
	 * JavaScript dla dostępności - TYLKO FRONTEND.
	 */
	public function add_accessibility_js() {
		// Tylko na frontendzie
		if ( ! $this->is_frontend() ) {
			return;
		}
		?>
		<script id="hotel-nowydwor-accessibility-js">
		(function() {
			'use strict';

			// Sprawdź czy jesteśmy na frontendzie (dodatkowe zabezpieczenie)
			if (document.body.classList.contains('wp-admin') || 
			    document.body.classList.contains('oxygen-builder-body') ||
			    window.location.href.indexOf('ct_builder') !== -1 ||
			    window.location.href.indexOf('oxygen_iframe') !== -1) {
				return;
			}

			// Dodaj ID do main content jeśli nie istnieje.
			var mainContent = document.querySelector('main, [role="main"], .main-content, #content, .content');
			if (mainContent && !mainContent.id) {
				mainContent.id = 'main-content';
			}

			// Dodaj ID do nawigacji głównej.
			var mainNav = document.querySelector('nav.main-navigation, .site-navigation, #primary-menu');
			if (mainNav && !mainNav.id) {
				mainNav.id = 'main-navigation';
			}

			// Dodaj ID do stopki.
			var footer = document.querySelector('footer, .site-footer, #footer');
			if (footer && !footer.id) {
				footer.id = 'footer';
			}

			// Dodaj role="main" jeśli nie istnieje.
			if (mainContent && !mainContent.hasAttribute('role')) {
				mainContent.setAttribute('role', 'main');
			}

			// Dodaj role="navigation" do nav elementów (tylko główne, nie w modals).
			document.querySelectorAll('body:not(.wp-admin) nav:not(.media-router)').forEach(function(nav) {
				// Pomijaj elementy w modals WordPress
				if (nav.closest('.media-modal') || nav.closest('.wp-media-wrapper')) {
					return;
				}
				if (!nav.hasAttribute('role')) {
					nav.setAttribute('role', 'navigation');
				}
				if (!nav.hasAttribute('aria-label') && !nav.hasAttribute('aria-labelledby')) {
					nav.setAttribute('aria-label', 'Nawigacja strony');
				}
			});

			// Dodaj role="banner" do header (tylko główny header).
			var header = document.querySelector('body:not(.wp-admin) > header, body:not(.wp-admin) .site-header, body:not(.wp-admin) #masthead');
			if (header && !header.hasAttribute('role')) {
				header.setAttribute('role', 'banner');
			}

			// Dodaj role="contentinfo" do footer.
			if (footer && !footer.hasAttribute('role')) {
				footer.setAttribute('role', 'contentinfo');
			}

			// Napraw obrazki bez alt - dodaj aria-hidden (tylko w głównej treści).
			var mainArea = document.querySelector('main, #main-content, .site-content');
			if (mainArea) {
				mainArea.querySelectorAll('img').forEach(function(img) {
					if (!img.hasAttribute('alt')) {
						img.setAttribute('alt', '');
						// Jeśli obrazek jest dekoracyjny.
						if (!img.closest('a') && !img.closest('button')) {
							img.setAttribute('aria-hidden', 'true');
							img.setAttribute('role', 'presentation');
						}
					}
				});
			}

			// Obsługa klawiatury dla elementów z onclick (tylko w głównej treści).
			if (mainArea) {
				mainArea.querySelectorAll('[onclick]').forEach(function(el) {
					// Pomijaj elementy WordPress admin
					if (el.closest('.media-modal') || el.closest('.wp-media-wrapper')) {
						return;
					}
					if (!el.hasAttribute('tabindex')) {
						el.setAttribute('tabindex', '0');
					}
					if (!el.hasAttribute('role') && el.tagName !== 'BUTTON' && el.tagName !== 'A') {
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
			}

			// Zewnętrzne linki - dodaj ostrzeżenie dla czytników ekranu (tylko w głównej treści).
			if (mainArea) {
				mainArea.querySelectorAll('a[target="_blank"]').forEach(function(link) {
					if (!link.querySelector('.hnd-sr-only') && !link.getAttribute('aria-label')) {
						var srText = document.createElement('span');
						srText.className = 'hnd-sr-only';
						srText.textContent = ' (otwiera się w nowym oknie)';
						link.appendChild(srText);

						// Dodaj rel="noopener" dla bezpieczeństwa.
						var rel = link.getAttribute('rel') || '';
						if (rel.indexOf('noopener') === -1) {
							link.setAttribute('rel', (rel + ' noopener').trim());
						}
					}
				});
			}

			// Popraw tabele - dodaj scope do nagłówków (tylko w głównej treści).
			if (mainArea) {
				mainArea.querySelectorAll('table').forEach(function(table) {
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
			}

			// Live region dla dynamicznych powiadomień.
			var liveRegion = document.getElementById('hnd-live-region');
			if (!liveRegion && mainArea) {
				liveRegion = document.createElement('div');
				liveRegion.setAttribute('aria-live', 'polite');
				liveRegion.setAttribute('aria-atomic', 'true');
				liveRegion.className = 'hnd-sr-only';
				liveRegion.id = 'hnd-live-region';
				document.body.appendChild(liveRegion);
			}

			// Funkcja do ogłaszania zmian.
			window.hndAnnounceToScreenReader = function(message) {
				var region = document.getElementById('hnd-live-region');
				if (region) {
					region.textContent = '';
					setTimeout(function() {
						region.textContent = message;
					}, 100);
				}
			};

			// Obsługa smooth scroll z respektowaniem prefers-reduced-motion.
			if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
				document.querySelectorAll('.hnd-skip-link, a[href^="#"]').forEach(function(anchor) {
					// Tylko linki wewnętrzne na tej samej stronie
					if (anchor.closest('.media-modal') || anchor.closest('.wp-media-wrapper')) {
						return;
					}
					
					anchor.addEventListener('click', function(e) {
						var href = this.getAttribute('href');
						if (href && href.startsWith('#') && href.length > 1) {
							var target = document.querySelector(href);
							if (target) {
								e.preventDefault();
								target.scrollIntoView({ behavior: 'smooth', block: 'start' });
								target.focus({ preventScroll: true });
							}
						}
					});
				});
			}

			// Dodaj aria-current="page" do aktualnej strony w menu (tylko główna nawigacja).
			var currentUrl = window.location.href.replace(/\/$/, '').split('?')[0].split('#')[0];
			document.querySelectorAll('.site-navigation a, .main-navigation a, #main-navigation a').forEach(function(link) {
				var linkUrl = link.href.replace(/\/$/, '').split('?')[0].split('#')[0];
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
		// Tylko na frontendzie
		if ( is_admin() ) {
			return $content;
		}

		// Dodaj role="figure" do figur z obrazkami.
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
		// Tylko na frontendzie, nie w adminie
		if ( is_admin() ) {
			return;
		}

		// Nie ładuj w Oxygen Builder
		if ( defined( 'SHOW_CT_BUILDER' ) && SHOW_CT_BUILDER ) {
			return;
		}

		if ( isset( $_GET['ct_builder'] ) || isset( $_GET['oxygen_iframe'] ) ) {
			return;
		}

		// Focus-visible polyfill dla starszych przeglądarek.
		wp_enqueue_script( 
			'focus-visible', 
			'https://unpkg.com/focus-visible@5.2.0/dist/focus-visible.min.js', 
			array(), 
			'5.2.0', 
			true 
		);
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
		// Tylko na frontendzie
		if ( is_admin() ) {
			return $form;
		}

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
			$label = '<label for="' . $search_id . '" class="hnd-sr-only">Szukaj:</label>';
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
		$sr_text = '<span class="hnd-sr-only">: ' . esc_html( $title ) . '</span>';

		return str_replace( '</a>', $sr_text . '</a>', $link );
	}

	/**
	 * Dostępny excerpt more.
	 */
	public function accessible_excerpt_more( $more ) {
		$title = get_the_title();
		return '... <a href="' . esc_url( get_permalink() ) . '" aria-label="Czytaj więcej o: ' . esc_attr( $title ) . '">Czytaj więcej<span class="hnd-sr-only">: ' . esc_html( $title ) . '</span></a>';
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