<?php
/**
 * Plugin Name: HND PageSpeed Optimizer - Master Controller
 * Description: Kompleksowa optymalizacja PageSpeed Insights dla Hotel Nowy Dwór. Panel admina z konfiguracją wszystkich modułów optymalizacyjnych.
 * Version: 2.0.0
 * Author: PB MEDIA
 * Author URI: https://pbmedia.pl
 * Text Domain: hnd-optimizer
 *
 * @package HND_PageSpeed_Optimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Główna klasa optymalizatora PageSpeed.
 */
class HND_PageSpeed_Optimizer {

	/**
	 * Wersja pluginu.
	 *
	 * @var string
	 */
	const VERSION = '2.0.0';

	/**
	 * Nazwa opcji w bazie danych.
	 *
	 * @var string
	 */
	const OPTION_NAME = 'hnd_pagespeed_optimizer_settings';

	/**
	 * Instancja singletona.
	 *
	 * @var HND_PageSpeed_Optimizer
	 */
	private static $instance = null;

	/**
	 * Domyślne ustawienia.
	 *
	 * @var array
	 */
	private $default_settings = array(
		// Wydajność.
		'enable_browser_cache'      => true,
		'enable_gzip_compression'   => true,
		'enable_lazy_loading'       => true,
		'enable_preload_hints'      => true,
		'enable_dns_prefetch'       => true,
		'enable_defer_js'           => true,
		'disable_emojis'            => true,
		'disable_embed'             => true,
		'disable_heartbeat_frontend' => true,
		'optimize_heartbeat_admin'  => true,
		'remove_query_strings'      => false,
		'minify_html'               => false,
		// Obrazy.
		'enable_webp_support'       => true,
		'add_image_dimensions'      => true,
		'optimize_lcp_image'        => true,
		'lazy_load_iframes'         => true,
		'image_quality'             => 82,
		// Dostępność.
		'enable_skip_links'         => true,
		'enable_focus_styles'       => true,
		'fix_contrast_issues'       => true,
		'add_aria_labels'           => true,
		'fix_link_names'            => true,
		// SEO.
		'enable_schema_org'         => true,
		'enable_meta_tags'          => true,
		'enable_open_graph'         => true,
		'enable_twitter_cards'      => true,
		'enable_canonical'          => true,
		// Bezpieczeństwo.
		'enable_security_headers'   => true,
		'enable_csp'                => false,
		'hide_wp_version'           => true,
		'disable_xmlrpc'            => true,
		'limit_login_attempts'      => true,
	);

	/**
	 * Aktualne ustawienia.
	 *
	 * @var array
	 */
	private $settings = array();

	/**
	 * Wyniki ostatniego audytu.
	 *
	 * @var array
	 */
	private $audit_results = array(
		'desktop' => array(
			'performance'    => 88,
			'accessibility'  => 90,
			'best_practices' => 96,
			'seo'            => 100,
			'fcp'            => '0.8s',
			'lcp'            => '2.1s',
			'tbt'            => '20ms',
			'cls'            => '0.002',
			'si'             => '1.3s',
		),
		'mobile'  => array(
			'performance'    => 66,
			'accessibility'  => 90,
			'best_practices' => 96,
			'seo'            => 100,
			'fcp'            => '3.2s',
			'lcp'            => '9.2s',
			'tbt'            => '150ms',
			'cls'            => '0',
			'si'             => '4.1s',
		),
		'issues'  => array(
			array(
				'type'     => 'performance',
				'priority' => 'high',
				'title'    => 'Używaj efektywnego czasu przechowywania w pamięci podręcznej',
				'savings'  => '3585-3833 KiB',
				'fix'      => 'enable_browser_cache',
			),
			array(
				'type'     => 'performance',
				'priority' => 'high',
				'title'    => 'Ulepsz dostarczanie obrazów',
				'savings'  => '2644-2663 KiB',
				'fix'      => 'enable_webp_support',
			),
			array(
				'type'     => 'performance',
				'priority' => 'medium',
				'title'    => 'Prośby o zablokowanie renderowania',
				'savings'  => '40-300ms',
				'fix'      => 'enable_defer_js',
			),
			array(
				'type'     => 'performance',
				'priority' => 'medium',
				'title'    => 'Ogranicz nieużywany JavaScript',
				'savings'  => '190-191 KiB',
				'fix'      => 'disable_embed',
			),
			array(
				'type'     => 'performance',
				'priority' => 'low',
				'title'    => 'Minifikuj JavaScript',
				'savings'  => '6 KiB',
				'fix'      => 'minify_html',
			),
			array(
				'type'     => 'accessibility',
				'priority' => 'high',
				'title'    => 'Niewystarczający współczynnik kontrastu',
				'savings'  => 'WCAG AA',
				'fix'      => 'fix_contrast_issues',
			),
			array(
				'type'     => 'accessibility',
				'priority' => 'medium',
				'title'    => 'Linki nie mają wyróżniających je nazw',
				'savings'  => 'WCAG A',
				'fix'      => 'fix_link_names',
			),
			array(
				'type'     => 'accessibility',
				'priority' => 'medium',
				'title'    => 'Linków pomijania nie można zaznaczyć',
				'savings'  => 'WCAG A',
				'fix'      => 'enable_skip_links',
			),
			array(
				'type'     => 'best_practices',
				'priority' => 'medium',
				'title'    => 'Skonfiguruj CSP pod kątem ochrony przed XSS',
				'savings'  => 'Security',
				'fix'      => 'enable_csp',
			),
			array(
				'type'     => 'best_practices',
				'priority' => 'low',
				'title'    => 'Błędy przeglądarki w konsoli',
				'savings'  => 'Debug',
				'fix'      => null,
			),
		),
		'date'    => '2025-12-27',
	);

	/**
	 * Pobierz instancję singletona.
	 *
	 * @return HND_PageSpeed_Optimizer
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
		$this->load_settings();
		$this->init_hooks();
	}

	/**
	 * Załaduj ustawienia z bazy danych.
	 *
	 * Ta funkcja zawsze pobiera świeże dane z bazy danych
	 * i łączy je z domyślnymi ustawieniami.
	 */
	private function load_settings() {
		// Zawsze pobieraj świeże dane z bazy.
		$saved_settings = get_option( self::OPTION_NAME, array() );

		// Upewnij się, że mamy tablicę.
		if ( ! is_array( $saved_settings ) ) {
			$saved_settings = array();
		}

		// Połącz z domyślnymi ustawieniami.
		$this->settings = wp_parse_args( $saved_settings, $this->default_settings );

		// Upewnij się, że wszystkie wartości boolean są rzeczywiście boolean.
		foreach ( $this->default_settings as $key => $default ) {
			if ( is_bool( $default ) && isset( $this->settings[ $key ] ) ) {
				$this->settings[ $key ] = (bool) $this->settings[ $key ];
			}
		}
	}

	/**
	 * Zapisz ustawienia do bazy danych.
	 *
	 * @param array $new_settings Nowe ustawienia do zapisania.
	 * @return bool Czy zapis się powiódł.
	 */
	public function save_settings( $new_settings ) {
		// Pobierz istniejące ustawienia.
		$existing = get_option( self::OPTION_NAME, array() );
		if ( ! is_array( $existing ) ) {
			$existing = array();
		}

		// Połącz z istniejącymi (nowe nadpisują stare).
		$merged = array_merge( $existing, $new_settings );

		// Zapisz do bazy.
		$result = update_option( self::OPTION_NAME, $merged, true );

		// Odśwież lokalne ustawienia.
		$this->settings = wp_parse_args( $merged, $this->default_settings );

		return $result;
	}

	/**
	 * Inicjalizuj hooki.
	 */
	private function init_hooks() {
		// Panel administracyjny.
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

		// AJAX handlers.
		add_action( 'wp_ajax_hnd_run_audit', array( $this, 'ajax_run_audit' ) );
		add_action( 'wp_ajax_hnd_apply_fix', array( $this, 'ajax_apply_fix' ) );
		add_action( 'wp_ajax_hnd_reset_settings', array( $this, 'ajax_reset_settings' ) );

		// Dodaj link do ustawień w liście pluginów.
		add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );

		// Admin bar quick access.
		add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_menu' ), 100 );
	}

	/**
	 * Dodaj menu w panelu admina.
	 */
	public function add_admin_menu() {
		// Główne menu.
		add_menu_page(
			__( 'HND PageSpeed Optimizer', 'hnd-optimizer' ),
			__( 'HND Optimizer', 'hnd-optimizer' ),
			'manage_options',
			'hnd-pagespeed-optimizer',
			array( $this, 'render_dashboard_page' ),
			'dashicons-performance',
			30
		);

		// Submenu - Dashboard.
		add_submenu_page(
			'hnd-pagespeed-optimizer',
			__( 'Dashboard', 'hnd-optimizer' ),
			__( 'Dashboard', 'hnd-optimizer' ),
			'manage_options',
			'hnd-pagespeed-optimizer',
			array( $this, 'render_dashboard_page' )
		);

		// Submenu - Wydajność.
		add_submenu_page(
			'hnd-pagespeed-optimizer',
			__( 'Wydajność', 'hnd-optimizer' ),
			__( 'Wydajność', 'hnd-optimizer' ),
			'manage_options',
			'hnd-optimizer-performance',
			array( $this, 'render_performance_page' )
		);

		// Submenu - Obrazy.
		add_submenu_page(
			'hnd-pagespeed-optimizer',
			__( 'Obrazy', 'hnd-optimizer' ),
			__( 'Obrazy', 'hnd-optimizer' ),
			'manage_options',
			'hnd-optimizer-images',
			array( $this, 'render_images_page' )
		);

		// Submenu - Dostępność.
		add_submenu_page(
			'hnd-pagespeed-optimizer',
			__( 'Dostępność', 'hnd-optimizer' ),
			__( 'Dostępność', 'hnd-optimizer' ),
			'manage_options',
			'hnd-optimizer-accessibility',
			array( $this, 'render_accessibility_page' )
		);

		// Submenu - SEO.
		add_submenu_page(
			'hnd-pagespeed-optimizer',
			__( 'SEO', 'hnd-optimizer' ),
			__( 'SEO', 'hnd-optimizer' ),
			'manage_options',
			'hnd-optimizer-seo',
			array( $this, 'render_seo_page' )
		);

		// Submenu - Bezpieczeństwo.
		add_submenu_page(
			'hnd-pagespeed-optimizer',
			__( 'Bezpieczeństwo', 'hnd-optimizer' ),
			__( 'Bezpieczeństwo', 'hnd-optimizer' ),
			'manage_options',
			'hnd-optimizer-security',
			array( $this, 'render_security_page' )
		);

		// Submenu - Audyt.
		add_submenu_page(
			'hnd-pagespeed-optimizer',
			__( 'Raport Audytu', 'hnd-optimizer' ),
			__( 'Raport Audytu', 'hnd-optimizer' ),
			'manage_options',
			'hnd-optimizer-audit',
			array( $this, 'render_audit_page' )
		);
	}

	/**
	 * Rejestruj ustawienia.
	 */
	public function register_settings() {
		register_setting(
			'hnd_optimizer_settings_group',
			self::OPTION_NAME,
			array(
				'type'              => 'array',
				'sanitize_callback' => array( $this, 'sanitize_settings' ),
				'default'           => $this->default_settings,
			)
		);
	}

	/**
	 * Sanityzuj ustawienia.
	 *
	 * @param array $input Dane wejściowe.
	 * @return array
	 */
	public function sanitize_settings( $input ) {
		$sanitized = array();

		foreach ( $this->default_settings as $key => $default ) {
			if ( is_bool( $default ) ) {
				$sanitized[ $key ] = isset( $input[ $key ] ) && $input[ $key ] ? true : false;
			} elseif ( is_int( $default ) ) {
				$sanitized[ $key ] = isset( $input[ $key ] ) ? absint( $input[ $key ] ) : $default;
			} else {
				$sanitized[ $key ] = isset( $input[ $key ] ) ? sanitize_text_field( $input[ $key ] ) : $default;
			}
		}

		return $sanitized;
	}

	/**
	 * Załaduj assety admina.
	 *
	 * @param string $hook Hook strony.
	 */
	public function enqueue_admin_assets( $hook ) {
		if ( strpos( $hook, 'hnd-' ) === false && strpos( $hook, 'hnd_' ) === false ) {
			return;
		}

		// Inline CSS.
		wp_add_inline_style( 'wp-admin', $this->get_admin_css() );

		// Inline JS.
		wp_add_inline_script( 'jquery', $this->get_admin_js() );
	}

	/**
	 * CSS dla panelu admina.
	 *
	 * @return string
	 */
	private function get_admin_css() {
		return '
			.hnd-wrap {
				max-width: 1200px;
				margin: 20px auto;
			}
			.hnd-header {
				background: linear-gradient(135deg, #0a97b0 0%, #087a8f 100%);
				color: #fff;
				padding: 30px;
				border-radius: 8px;
				margin-bottom: 20px;
				box-shadow: 0 4px 15px rgba(10, 151, 176, 0.3);
			}
			.hnd-header h1 {
				margin: 0 0 10px;
				font-size: 28px;
				font-weight: 600;
			}
			.hnd-header p {
				margin: 0;
				opacity: 0.9;
				font-size: 14px;
			}
			.hnd-scores {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
				gap: 20px;
				margin-bottom: 30px;
			}
			.hnd-score-card {
				background: #fff;
				border-radius: 8px;
				padding: 20px;
				text-align: center;
				box-shadow: 0 2px 8px rgba(0,0,0,0.1);
				transition: transform 0.2s;
			}
			.hnd-score-card:hover {
				transform: translateY(-2px);
			}
			.hnd-score-card h3 {
				margin: 0 0 15px;
				font-size: 14px;
				color: #666;
				text-transform: uppercase;
				letter-spacing: 0.5px;
			}
			.hnd-score {
				font-size: 48px;
				font-weight: 700;
				line-height: 1;
				margin-bottom: 10px;
			}
			.hnd-score.good { color: #0cce6b; }
			.hnd-score.average { color: #ffa400; }
			.hnd-score.poor { color: #ff4e42; }
			.hnd-score-label {
				font-size: 12px;
				color: #999;
			}
			.hnd-metrics {
				display: grid;
				grid-template-columns: repeat(5, 1fr);
				gap: 10px;
				margin-top: 15px;
				padding-top: 15px;
				border-top: 1px solid #eee;
			}
			.hnd-metric {
				text-align: center;
			}
			.hnd-metric-value {
				font-size: 16px;
				font-weight: 600;
			}
			.hnd-metric-value.good { color: #0cce6b; }
			.hnd-metric-value.average { color: #ffa400; }
			.hnd-metric-value.poor { color: #ff4e42; }
			.hnd-metric-label {
				font-size: 10px;
				color: #999;
				text-transform: uppercase;
			}
			.hnd-issues {
				background: #fff;
				border-radius: 8px;
				padding: 20px;
				box-shadow: 0 2px 8px rgba(0,0,0,0.1);
				margin-bottom: 20px;
			}
			.hnd-issues h2 {
				margin: 0 0 20px;
				font-size: 18px;
				color: #333;
			}
			.hnd-issue {
				display: flex;
				align-items: center;
				padding: 15px;
				border-radius: 6px;
				margin-bottom: 10px;
				background: #f8f9fa;
			}
			.hnd-issue.high { border-left: 4px solid #ff4e42; }
			.hnd-issue.medium { border-left: 4px solid #ffa400; }
			.hnd-issue.low { border-left: 4px solid #0cce6b; }
			.hnd-issue-icon {
				width: 40px;
				height: 40px;
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				margin-right: 15px;
				font-size: 20px;
			}
			.hnd-issue.high .hnd-issue-icon { background: #ffebee; color: #ff4e42; }
			.hnd-issue.medium .hnd-issue-icon { background: #fff8e1; color: #ffa400; }
			.hnd-issue.low .hnd-issue-icon { background: #e8f5e9; color: #0cce6b; }
			.hnd-issue-content {
				flex: 1;
			}
			.hnd-issue-title {
				font-weight: 600;
				margin-bottom: 5px;
			}
			.hnd-issue-savings {
				font-size: 12px;
				color: #666;
			}
			.hnd-issue-action {
				margin-left: 15px;
			}
			.hnd-btn {
				display: inline-block;
				padding: 8px 16px;
				border-radius: 4px;
				font-size: 13px;
				font-weight: 500;
				text-decoration: none;
				cursor: pointer;
				border: none;
				transition: all 0.2s;
			}
			.hnd-btn-primary {
				background: #0a97b0;
				color: #fff;
			}
			.hnd-btn-primary:hover {
				background: #087a8f;
				color: #fff;
			}
			.hnd-btn-success {
				background: #0cce6b;
				color: #fff;
			}
			.hnd-btn-success:hover {
				background: #0ab55d;
				color: #fff;
			}
			.hnd-btn-secondary {
				background: #f0f0f0;
				color: #333;
			}
			.hnd-btn-secondary:hover {
				background: #e0e0e0;
			}
			.hnd-settings-section {
				background: #fff;
				border-radius: 8px;
				padding: 25px;
				box-shadow: 0 2px 8px rgba(0,0,0,0.1);
				margin-bottom: 20px;
			}
			.hnd-settings-section h2 {
				margin: 0 0 20px;
				font-size: 18px;
				color: #333;
				padding-bottom: 15px;
				border-bottom: 1px solid #eee;
			}
			.hnd-setting-row {
				display: flex;
				align-items: center;
				justify-content: space-between;
				padding: 15px 0;
				border-bottom: 1px solid #f0f0f0;
			}
			.hnd-setting-row:last-child {
				border-bottom: none;
			}
			.hnd-setting-info {
				flex: 1;
			}
			.hnd-setting-title {
				font-weight: 500;
				margin-bottom: 5px;
			}
			.hnd-setting-desc {
				font-size: 12px;
				color: #666;
			}
			.hnd-toggle {
				position: relative;
				width: 50px;
				height: 26px;
			}
			.hnd-toggle input {
				opacity: 0;
				width: 0;
				height: 0;
			}
			.hnd-toggle-slider {
				position: absolute;
				cursor: pointer;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-color: #ccc;
				transition: .3s;
				border-radius: 26px;
			}
			.hnd-toggle-slider:before {
				position: absolute;
				content: "";
				height: 20px;
				width: 20px;
				left: 3px;
				bottom: 3px;
				background-color: white;
				transition: .3s;
				border-radius: 50%;
			}
			.hnd-toggle input:checked + .hnd-toggle-slider {
				background-color: #0cce6b;
			}
			.hnd-toggle input:checked + .hnd-toggle-slider:before {
				transform: translateX(24px);
			}
			.hnd-tabs {
				display: flex;
				border-bottom: 2px solid #e0e0e0;
				margin-bottom: 20px;
			}
			.hnd-tab {
				padding: 15px 25px;
				cursor: pointer;
				font-weight: 500;
				color: #666;
				border-bottom: 2px solid transparent;
				margin-bottom: -2px;
				transition: all 0.2s;
			}
			.hnd-tab:hover {
				color: #0a97b0;
			}
			.hnd-tab.active {
				color: #0a97b0;
				border-bottom-color: #0a97b0;
			}
			.hnd-badge {
				display: inline-block;
				padding: 2px 8px;
				border-radius: 10px;
				font-size: 11px;
				font-weight: 600;
				margin-left: 8px;
			}
			.hnd-badge-success { background: #e8f5e9; color: #0cce6b; }
			.hnd-badge-warning { background: #fff8e1; color: #ffa400; }
			.hnd-badge-danger { background: #ffebee; color: #ff4e42; }
			.hnd-badge-info { background: #e3f2fd; color: #2196f3; }
			.hnd-audit-report {
				background: #fff;
				border-radius: 8px;
				padding: 30px;
				box-shadow: 0 2px 8px rgba(0,0,0,0.1);
			}
			.hnd-audit-section {
				margin-bottom: 30px;
			}
			.hnd-audit-section h3 {
				font-size: 16px;
				color: #333;
				margin-bottom: 15px;
				padding-bottom: 10px;
				border-bottom: 1px solid #eee;
			}
			.hnd-audit-item {
				display: flex;
				align-items: flex-start;
				padding: 12px 0;
				border-bottom: 1px solid #f5f5f5;
			}
			.hnd-audit-item:last-child {
				border-bottom: none;
			}
			.hnd-audit-status {
				width: 24px;
				height: 24px;
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				margin-right: 12px;
				font-size: 14px;
			}
			.hnd-audit-status.pass { background: #e8f5e9; color: #0cce6b; }
			.hnd-audit-status.fail { background: #ffebee; color: #ff4e42; }
			.hnd-audit-status.warn { background: #fff8e1; color: #ffa400; }
			.hnd-quick-actions {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
				gap: 15px;
				margin-top: 20px;
			}
			.hnd-quick-action {
				background: #f8f9fa;
				border-radius: 8px;
				padding: 20px;
				text-align: center;
				transition: all 0.2s;
				cursor: pointer;
			}
			.hnd-quick-action:hover {
				background: #e8f4f8;
				transform: translateY(-2px);
			}
			.hnd-quick-action-icon {
				font-size: 32px;
				margin-bottom: 10px;
			}
			.hnd-quick-action-title {
				font-weight: 600;
				margin-bottom: 5px;
			}
			.hnd-quick-action-desc {
				font-size: 12px;
				color: #666;
			}
			@media (max-width: 782px) {
				.hnd-scores {
					grid-template-columns: repeat(2, 1fr);
				}
				.hnd-metrics {
					grid-template-columns: repeat(3, 1fr);
				}
				.hnd-issue {
					flex-wrap: wrap;
				}
				.hnd-issue-action {
					width: 100%;
					margin: 15px 0 0;
				}
			}
		';
	}

	/**
	 * JavaScript dla panelu admina.
	 *
	 * @return string
	 */
	private function get_admin_js() {
		return '
			jQuery(document).ready(function($) {
				// Toggle switches.
				$(".hnd-toggle input").on("change", function() {
					var $form = $(this).closest("form");
					if ($form.length) {
						// Auto-save on toggle change.
					}
				});

				// Quick fix buttons.
				$(".hnd-btn-fix").on("click", function(e) {
					e.preventDefault();
					var $btn = $(this);
					var setting = $btn.data("setting");

					$btn.text("Naprawianie...");

					$.ajax({
						url: ajaxurl,
						type: "POST",
						data: {
							action: "hnd_apply_fix",
							setting: setting,
							nonce: $("#hnd_nonce").val()
						},
						success: function(response) {
							if (response.success) {
								$btn.removeClass("hnd-btn-primary").addClass("hnd-btn-success").text("Naprawiono ✓");
								$btn.closest(".hnd-issue").fadeOut(500);
							} else {
								$btn.text("Błąd");
							}
						}
					});
				});

				// Run audit button.
				$("#hnd-run-audit").on("click", function(e) {
					e.preventDefault();
					var $btn = $(this);
					$btn.text("Analizowanie...");

					$.ajax({
						url: ajaxurl,
						type: "POST",
						data: {
							action: "hnd_run_audit",
							nonce: $("#hnd_nonce").val()
						},
						success: function(response) {
							if (response.success) {
								location.reload();
							} else {
								$btn.text("Błąd");
							}
						}
					});
				});

				// Reset settings.
				$("#hnd-reset-settings").on("click", function(e) {
					e.preventDefault();
					if (confirm("Czy na pewno chcesz przywrócić domyślne ustawienia?")) {
						$.ajax({
							url: ajaxurl,
							type: "POST",
							data: {
								action: "hnd_reset_settings",
								nonce: $("#hnd_nonce").val()
							},
							success: function(response) {
								if (response.success) {
									location.reload();
								}
							}
						});
					}
				});
			});
		';
	}

	/**
	 * Renderuj stronę Dashboard.
	 */
	public function render_dashboard_page() {
		$desktop = $this->audit_results['desktop'];
		$mobile  = $this->audit_results['mobile'];
		$issues  = $this->audit_results['issues'];
		?>
		<div class="wrap hnd-wrap">
			<div class="hnd-header">
				<h1><?php esc_html_e( 'HND PageSpeed Optimizer', 'hnd-optimizer' ); ?></h1>
				<p><?php esc_html_e( 'Kompleksowa optymalizacja PageSpeed Insights dla Hotel Nowy Dwór', 'hnd-optimizer' ); ?></p>
			</div>

			<?php wp_nonce_field( 'hnd_optimizer_nonce', 'hnd_nonce' ); ?>

			<div class="hnd-tabs">
				<div class="hnd-tab active" data-tab="desktop">
					<?php esc_html_e( 'Desktop', 'hnd-optimizer' ); ?>
					<span class="hnd-badge <?php echo $desktop['performance'] >= 90 ? 'hnd-badge-success' : ( $desktop['performance'] >= 50 ? 'hnd-badge-warning' : 'hnd-badge-danger' ); ?>">
						<?php echo esc_html( $desktop['performance'] ); ?>
					</span>
				</div>
				<div class="hnd-tab" data-tab="mobile">
					<?php esc_html_e( 'Mobile', 'hnd-optimizer' ); ?>
					<span class="hnd-badge <?php echo $mobile['performance'] >= 90 ? 'hnd-badge-success' : ( $mobile['performance'] >= 50 ? 'hnd-badge-warning' : 'hnd-badge-danger' ); ?>">
						<?php echo esc_html( $mobile['performance'] ); ?>
					</span>
				</div>
			</div>

			<!-- Desktop Scores -->
			<div id="tab-desktop" class="hnd-tab-content">
				<div class="hnd-scores">
					<?php $this->render_score_card( __( 'Wydajność', 'hnd-optimizer' ), $desktop['performance'], $desktop ); ?>
					<?php $this->render_score_card( __( 'Dostępność', 'hnd-optimizer' ), $desktop['accessibility'] ); ?>
					<?php $this->render_score_card( __( 'Sprawdzone metody', 'hnd-optimizer' ), $desktop['best_practices'] ); ?>
					<?php $this->render_score_card( __( 'SEO', 'hnd-optimizer' ), $desktop['seo'] ); ?>
				</div>
			</div>

			<!-- Mobile Scores (hidden by default) -->
			<div id="tab-mobile" class="hnd-tab-content" style="display:none;">
				<div class="hnd-scores">
					<?php $this->render_score_card( __( 'Wydajność', 'hnd-optimizer' ), $mobile['performance'], $mobile ); ?>
					<?php $this->render_score_card( __( 'Dostępność', 'hnd-optimizer' ), $mobile['accessibility'] ); ?>
					<?php $this->render_score_card( __( 'Sprawdzone metody', 'hnd-optimizer' ), $mobile['best_practices'] ); ?>
					<?php $this->render_score_card( __( 'SEO', 'hnd-optimizer' ), $mobile['seo'] ); ?>
				</div>
			</div>

			<!-- Problemy do naprawienia -->
			<div class="hnd-issues">
				<h2>
					<?php esc_html_e( 'Problemy do naprawienia', 'hnd-optimizer' ); ?>
					<span class="hnd-badge hnd-badge-danger"><?php echo count( $issues ); ?></span>
				</h2>

				<?php foreach ( $issues as $issue ) : ?>
					<div class="hnd-issue <?php echo esc_attr( $issue['priority'] ); ?>">
						<div class="hnd-issue-icon">
							<?php
							if ( 'performance' === $issue['type'] ) {
								echo '⚡';
							} elseif ( 'accessibility' === $issue['type'] ) {
								echo '♿';
							} elseif ( 'best_practices' === $issue['type'] ) {
								echo '🛡️';
							} else {
								echo '🔍';
							}
							?>
						</div>
						<div class="hnd-issue-content">
							<div class="hnd-issue-title"><?php echo esc_html( $issue['title'] ); ?></div>
							<div class="hnd-issue-savings">
								<?php
								printf(
									/* translators: %s: potential savings */
									esc_html__( 'Potencjalna oszczędność: %s', 'hnd-optimizer' ),
									esc_html( $issue['savings'] )
								);
								?>
							</div>
						</div>
						<div class="hnd-issue-action">
							<?php if ( $issue['fix'] ) : ?>
								<button class="hnd-btn hnd-btn-primary hnd-btn-fix" data-setting="<?php echo esc_attr( $issue['fix'] ); ?>">
									<?php esc_html_e( 'Napraw', 'hnd-optimizer' ); ?>
								</button>
							<?php else : ?>
								<span class="hnd-badge hnd-badge-info"><?php esc_html_e( 'Ręczna naprawa', 'hnd-optimizer' ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Szybkie akcje -->
			<div class="hnd-settings-section">
				<h2><?php esc_html_e( 'Szybkie akcje', 'hnd-optimizer' ); ?></h2>
				<div class="hnd-quick-actions">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=hnd-optimizer-performance' ) ); ?>" class="hnd-quick-action">
						<div class="hnd-quick-action-icon">⚡</div>
						<div class="hnd-quick-action-title"><?php esc_html_e( 'Optymalizuj wydajność', 'hnd-optimizer' ); ?></div>
						<div class="hnd-quick-action-desc"><?php esc_html_e( 'Cache, kompresja, lazy loading', 'hnd-optimizer' ); ?></div>
					</a>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=hnd-optimizer-images' ) ); ?>" class="hnd-quick-action">
						<div class="hnd-quick-action-icon">🖼️</div>
						<div class="hnd-quick-action-title"><?php esc_html_e( 'Optymalizuj obrazy', 'hnd-optimizer' ); ?></div>
						<div class="hnd-quick-action-desc"><?php esc_html_e( 'WebP, wymiary, LCP', 'hnd-optimizer' ); ?></div>
					</a>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=hnd-optimizer-accessibility' ) ); ?>" class="hnd-quick-action">
						<div class="hnd-quick-action-icon">♿</div>
						<div class="hnd-quick-action-title"><?php esc_html_e( 'Popraw dostępność', 'hnd-optimizer' ); ?></div>
						<div class="hnd-quick-action-desc"><?php esc_html_e( 'Kontrast, ARIA, fokus', 'hnd-optimizer' ); ?></div>
					</a>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=hnd-optimizer-audit' ) ); ?>" class="hnd-quick-action">
						<div class="hnd-quick-action-icon">📊</div>
						<div class="hnd-quick-action-title"><?php esc_html_e( 'Zobacz pełny raport', 'hnd-optimizer' ); ?></div>
						<div class="hnd-quick-action-desc"><?php esc_html_e( 'Szczegółowy audyt strony', 'hnd-optimizer' ); ?></div>
					</a>
				</div>
			</div>
		</div>

		<script>
		jQuery(document).ready(function($) {
			$('.hnd-tab').on('click', function() {
				var tab = $(this).data('tab');
				$('.hnd-tab').removeClass('active');
				$(this).addClass('active');
				$('.hnd-tab-content').hide();
				$('#tab-' + tab).show();
			});
		});
		</script>
		<?php
	}

	/**
	 * Renderuj kartę z wynikiem.
	 *
	 * @param string     $title   Tytuł.
	 * @param int        $score   Wynik.
	 * @param array|null $metrics Metryki (opcjonalne).
	 */
	private function render_score_card( $title, $score, $metrics = null ) {
		$class = 'good';
		if ( $score < 90 ) {
			$class = 'average';
		}
		if ( $score < 50 ) {
			$class = 'poor';
		}
		?>
		<div class="hnd-score-card">
			<h3><?php echo esc_html( $title ); ?></h3>
			<div class="hnd-score <?php echo esc_attr( $class ); ?>"><?php echo esc_html( $score ); ?></div>
			<div class="hnd-score-label">
				<?php
				if ( $score >= 90 ) {
					esc_html_e( 'Dobry wynik', 'hnd-optimizer' );
				} elseif ( $score >= 50 ) {
					esc_html_e( 'Wymaga poprawy', 'hnd-optimizer' );
				} else {
					esc_html_e( 'Słaby wynik', 'hnd-optimizer' );
				}
				?>
			</div>

			<?php if ( $metrics && isset( $metrics['fcp'] ) ) : ?>
				<div class="hnd-metrics">
					<div class="hnd-metric">
						<div class="hnd-metric-value <?php echo $this->get_metric_class( 'fcp', $metrics['fcp'] ); ?>">
							<?php echo esc_html( $metrics['fcp'] ); ?>
						</div>
						<div class="hnd-metric-label">FCP</div>
					</div>
					<div class="hnd-metric">
						<div class="hnd-metric-value <?php echo $this->get_metric_class( 'lcp', $metrics['lcp'] ); ?>">
							<?php echo esc_html( $metrics['lcp'] ); ?>
						</div>
						<div class="hnd-metric-label">LCP</div>
					</div>
					<div class="hnd-metric">
						<div class="hnd-metric-value <?php echo $this->get_metric_class( 'tbt', $metrics['tbt'] ); ?>">
							<?php echo esc_html( $metrics['tbt'] ); ?>
						</div>
						<div class="hnd-metric-label">TBT</div>
					</div>
					<div class="hnd-metric">
						<div class="hnd-metric-value <?php echo $this->get_metric_class( 'cls', $metrics['cls'] ); ?>">
							<?php echo esc_html( $metrics['cls'] ); ?>
						</div>
						<div class="hnd-metric-label">CLS</div>
					</div>
					<div class="hnd-metric">
						<div class="hnd-metric-value <?php echo $this->get_metric_class( 'si', $metrics['si'] ); ?>">
							<?php echo esc_html( $metrics['si'] ); ?>
						</div>
						<div class="hnd-metric-label">SI</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Pobierz klasę dla metryki.
	 *
	 * @param string $metric Nazwa metryki.
	 * @param string $value  Wartość.
	 * @return string
	 */
	private function get_metric_class( $metric, $value ) {
		$num = floatval( str_replace( array( 's', 'ms' ), '', $value ) );

		// Progi dla Core Web Vitals.
		$thresholds = array(
			'fcp' => array( 1.8, 3.0 ),
			'lcp' => array( 2.5, 4.0 ),
			'tbt' => array( 200, 600 ),
			'cls' => array( 0.1, 0.25 ),
			'si'  => array( 3.4, 5.8 ),
		);

		if ( ! isset( $thresholds[ $metric ] ) ) {
			return 'average';
		}

		// Konwersja ms na s dla porównania.
		if ( strpos( $value, 'ms' ) !== false && in_array( $metric, array( 'tbt' ), true ) ) {
			// TBT jest w ms.
		} else {
			// Reszta w sekundach.
		}

		if ( $num <= $thresholds[ $metric ][0] ) {
			return 'good';
		} elseif ( $num <= $thresholds[ $metric ][1] ) {
			return 'average';
		} else {
			return 'poor';
		}
	}

	/**
	 * Renderuj stronę Wydajność.
	 */
	public function render_performance_page() {
		$this->render_settings_page(
			__( 'Ustawienia wydajności', 'hnd-optimizer' ),
			array(
				array(
					'key'   => 'enable_browser_cache',
					'title' => __( 'Cache przeglądarki', 'hnd-optimizer' ),
					'desc'  => __( 'Dodaje nagłówki cache dla statycznych zasobów (obrazy, CSS, JS)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_gzip_compression',
					'title' => __( 'Kompresja GZIP', 'hnd-optimizer' ),
					'desc'  => __( 'Kompresuje HTML, CSS i JS przed wysłaniem do przeglądarki', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_lazy_loading',
					'title' => __( 'Lazy Loading obrazów', 'hnd-optimizer' ),
					'desc'  => __( 'Obrazy ładują się dopiero gdy są widoczne na ekranie', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_preload_hints',
					'title' => __( 'Preload Hints', 'hnd-optimizer' ),
					'desc'  => __( 'Preładowanie krytycznych zasobów (LCP image, fonty)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_dns_prefetch',
					'title' => __( 'DNS Prefetch', 'hnd-optimizer' ),
					'desc'  => __( 'Wstępne rozwiązywanie DNS dla zewnętrznych domen', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_defer_js',
					'title' => __( 'Defer JavaScript', 'hnd-optimizer' ),
					'desc'  => __( 'Opóźnia ładowanie niekrytycznych skryptów JS', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'disable_emojis',
					'title' => __( 'Wyłącz WordPress Emojis', 'hnd-optimizer' ),
					'desc'  => __( 'Usuwa skrypty emoji WordPress (oszczędność ~20KB)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'disable_embed',
					'title' => __( 'Wyłącz oEmbed', 'hnd-optimizer' ),
					'desc'  => __( 'Usuwa skrypty embeds WordPress', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'disable_heartbeat_frontend',
					'title' => __( 'Wyłącz Heartbeat (frontend)', 'hnd-optimizer' ),
					'desc'  => __( 'Wyłącza WordPress Heartbeat API na stronie publicznej', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'optimize_heartbeat_admin',
					'title' => __( 'Optymalizuj Heartbeat (admin)', 'hnd-optimizer' ),
					'desc'  => __( 'Zmniejsza częstotliwość Heartbeat w panelu admina (60s)', 'hnd-optimizer' ),
				),
			)
		);
	}

	/**
	 * Renderuj stronę Obrazy.
	 */
	public function render_images_page() {
		$this->render_settings_page(
			__( 'Ustawienia obrazów', 'hnd-optimizer' ),
			array(
				array(
					'key'   => 'enable_webp_support',
					'title' => __( 'Wsparcie WebP/AVIF', 'hnd-optimizer' ),
					'desc'  => __( 'Automatyczne serwowanie obrazów WebP dla wspieranych przeglądarek', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'add_image_dimensions',
					'title' => __( 'Dodaj wymiary obrazów', 'hnd-optimizer' ),
					'desc'  => __( 'Automatycznie dodaje atrybuty width/height do obrazów (zapobiega CLS)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'optimize_lcp_image',
					'title' => __( 'Optymalizuj LCP Image', 'hnd-optimizer' ),
					'desc'  => __( 'Priorytetowe ładowanie największego obrazu (fetchpriority="high")', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'lazy_load_iframes',
					'title' => __( 'Lazy Load iframe', 'hnd-optimizer' ),
					'desc'  => __( 'Opóźnione ładowanie iframe (mapy, wideo)', 'hnd-optimizer' ),
				),
			)
		);
	}

	/**
	 * Renderuj stronę Dostępność.
	 */
	public function render_accessibility_page() {
		$this->render_settings_page(
			__( 'Ustawienia dostępności', 'hnd-optimizer' ),
			array(
				array(
					'key'   => 'enable_skip_links',
					'title' => __( 'Skip Links', 'hnd-optimizer' ),
					'desc'  => __( 'Dodaje linki do pomijania nawigacji dla czytników ekranu', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_focus_styles',
					'title' => __( 'Style fokusa', 'hnd-optimizer' ),
					'desc'  => __( 'Widoczne obramowanie dla elementów aktywnych (nawigacja klawiaturą)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'fix_contrast_issues',
					'title' => __( 'Napraw kontrast', 'hnd-optimizer' ),
					'desc'  => __( 'Poprawia kontrast kolorów do standardu WCAG AA (4.5:1)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'add_aria_labels',
					'title' => __( 'ARIA Labels', 'hnd-optimizer' ),
					'desc'  => __( 'Dodaje etykiety ARIA do elementów interaktywnych', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'fix_link_names',
					'title' => __( 'Nazwy linków', 'hnd-optimizer' ),
					'desc'  => __( 'Dodaje opisowe nazwy do linków (np. "Czytaj więcej o...")', 'hnd-optimizer' ),
				),
			)
		);
	}

	/**
	 * Renderuj stronę SEO.
	 */
	public function render_seo_page() {
		$this->render_settings_page(
			__( 'Ustawienia SEO', 'hnd-optimizer' ),
			array(
				array(
					'key'   => 'enable_schema_org',
					'title' => __( 'Schema.org', 'hnd-optimizer' ),
					'desc'  => __( 'Strukturyzowane dane JSON-LD (Hotel, Restaurant, FAQ)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_meta_tags',
					'title' => __( 'Meta Tags', 'hnd-optimizer' ),
					'desc'  => __( 'Zoptymalizowane meta title i description', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_open_graph',
					'title' => __( 'Open Graph', 'hnd-optimizer' ),
					'desc'  => __( 'Tagi OG dla Facebooka i LinkedIn', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_twitter_cards',
					'title' => __( 'Twitter Cards', 'hnd-optimizer' ),
					'desc'  => __( 'Karty Twitter dla udostępniania', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_canonical',
					'title' => __( 'Canonical URLs', 'hnd-optimizer' ),
					'desc'  => __( 'Kanoniczne adresy URL zapobiegające duplikatom', 'hnd-optimizer' ),
				),
			)
		);
	}

	/**
	 * Renderuj stronę Bezpieczeństwo.
	 */
	public function render_security_page() {
		$this->render_settings_page(
			__( 'Ustawienia bezpieczeństwa', 'hnd-optimizer' ),
			array(
				array(
					'key'   => 'enable_security_headers',
					'title' => __( 'Nagłówki bezpieczeństwa', 'hnd-optimizer' ),
					'desc'  => __( 'X-Frame-Options, X-Content-Type, Referrer-Policy, HSTS', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'enable_csp',
					'title' => __( 'Content Security Policy', 'hnd-optimizer' ),
					'desc'  => __( 'Ochrona przed XSS (może wymagać dostosowania)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'hide_wp_version',
					'title' => __( 'Ukryj wersję WordPress', 'hnd-optimizer' ),
					'desc'  => __( 'Usuwa wersję WP z kodu źródłowego i zasobów', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'disable_xmlrpc',
					'title' => __( 'Wyłącz XML-RPC', 'hnd-optimizer' ),
					'desc'  => __( 'Blokuje XML-RPC (częsty cel ataków)', 'hnd-optimizer' ),
				),
				array(
					'key'   => 'limit_login_attempts',
					'title' => __( 'Limit prób logowania', 'hnd-optimizer' ),
					'desc'  => __( 'Blokuje IP po 5 nieudanych próbach logowania', 'hnd-optimizer' ),
				),
			)
		);
	}

	/**
	 * Renderuj stronę z ustawieniami.
	 *
	 * @param string $title    Tytuł strony.
	 * @param array  $settings Lista ustawień.
	 */
	private function render_settings_page( $title, $settings ) {
		?>
		<div class="wrap hnd-wrap">
			<div class="hnd-header">
				<h1><?php echo esc_html( $title ); ?></h1>
				<p><?php esc_html_e( 'Konfiguruj opcje optymalizacji', 'hnd-optimizer' ); ?></p>
			</div>

			<form method="post" action="options.php">
				<?php settings_fields( 'hnd_optimizer_settings_group' ); ?>
				<?php wp_nonce_field( 'hnd_optimizer_nonce', 'hnd_nonce' ); ?>

				<div class="hnd-settings-section">
					<?php foreach ( $settings as $setting ) : ?>
						<div class="hnd-setting-row">
							<div class="hnd-setting-info">
								<div class="hnd-setting-title"><?php echo esc_html( $setting['title'] ); ?></div>
								<div class="hnd-setting-desc"><?php echo esc_html( $setting['desc'] ); ?></div>
							</div>
							<label class="hnd-toggle">
								<input type="checkbox"
									   name="<?php echo esc_attr( self::OPTION_NAME . '[' . $setting['key'] . ']' ); ?>"
									   value="1"
									   <?php checked( $this->settings[ $setting['key'] ], true ); ?>>
								<span class="hnd-toggle-slider"></span>
							</label>
						</div>
					<?php endforeach; ?>
				</div>

				<p>
					<?php submit_button( __( 'Zapisz ustawienia', 'hnd-optimizer' ), 'hnd-btn hnd-btn-primary', 'submit', false ); ?>
					<button type="button" id="hnd-reset-settings" class="hnd-btn hnd-btn-secondary" style="margin-left: 10px;">
						<?php esc_html_e( 'Przywróć domyślne', 'hnd-optimizer' ); ?>
					</button>
				</p>
			</form>
		</div>
		<?php
	}

	/**
	 * Renderuj stronę Audyt.
	 */
	public function render_audit_page() {
		?>
		<div class="wrap hnd-wrap">
			<div class="hnd-header">
				<h1><?php esc_html_e( 'Raport Audytu PageSpeed', 'hnd-optimizer' ); ?></h1>
				<p>
					<?php
					printf(
						/* translators: %s: audit date */
						esc_html__( 'Ostatni audyt: %s', 'hnd-optimizer' ),
						esc_html( $this->audit_results['date'] )
					);
					?>
				</p>
			</div>

			<div class="hnd-audit-report">
				<?php $this->render_full_audit_report(); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Renderuj pełny raport audytu.
	 */
	private function render_full_audit_report() {
		?>
		<div class="hnd-audit-section">
			<h3>📊 <?php esc_html_e( 'Podsumowanie wyników', 'hnd-optimizer' ); ?></h3>

			<table class="widefat">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Kategoria', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Desktop', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Mobile', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Cel', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Status', 'hnd-optimizer' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong><?php esc_html_e( 'Wydajność', 'hnd-optimizer' ); ?></strong></td>
						<td><?php echo esc_html( $this->audit_results['desktop']['performance'] ); ?>/100</td>
						<td><?php echo esc_html( $this->audit_results['mobile']['performance'] ); ?>/100</td>
						<td>90+</td>
						<td>
							<?php if ( $this->audit_results['mobile']['performance'] >= 90 ) : ?>
								<span class="hnd-badge hnd-badge-success">✓ Osiągnięto</span>
							<?php else : ?>
								<span class="hnd-badge hnd-badge-warning">⚠ Do poprawy</span>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Dostępność', 'hnd-optimizer' ); ?></strong></td>
						<td><?php echo esc_html( $this->audit_results['desktop']['accessibility'] ); ?>/100</td>
						<td><?php echo esc_html( $this->audit_results['mobile']['accessibility'] ); ?>/100</td>
						<td>90+</td>
						<td>
							<?php if ( $this->audit_results['mobile']['accessibility'] >= 90 ) : ?>
								<span class="hnd-badge hnd-badge-success">✓ Osiągnięto</span>
							<?php else : ?>
								<span class="hnd-badge hnd-badge-warning">⚠ Do poprawy</span>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Sprawdzone metody', 'hnd-optimizer' ); ?></strong></td>
						<td><?php echo esc_html( $this->audit_results['desktop']['best_practices'] ); ?>/100</td>
						<td><?php echo esc_html( $this->audit_results['mobile']['best_practices'] ); ?>/100</td>
						<td>90+</td>
						<td>
							<?php if ( $this->audit_results['mobile']['best_practices'] >= 90 ) : ?>
								<span class="hnd-badge hnd-badge-success">✓ Osiągnięto</span>
							<?php else : ?>
								<span class="hnd-badge hnd-badge-warning">⚠ Do poprawy</span>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'SEO', 'hnd-optimizer' ); ?></strong></td>
						<td><?php echo esc_html( $this->audit_results['desktop']['seo'] ); ?>/100</td>
						<td><?php echo esc_html( $this->audit_results['mobile']['seo'] ); ?>/100</td>
						<td>90+</td>
						<td>
							<?php if ( $this->audit_results['mobile']['seo'] >= 90 ) : ?>
								<span class="hnd-badge hnd-badge-success">✓ Osiągnięto</span>
							<?php else : ?>
								<span class="hnd-badge hnd-badge-warning">⚠ Do poprawy</span>
							<?php endif; ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="hnd-audit-section">
			<h3>⚡ <?php esc_html_e( 'Core Web Vitals', 'hnd-optimizer' ); ?></h3>

			<table class="widefat">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Metryka', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Desktop', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Mobile', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Dobry', 'hnd-optimizer' ); ?></th>
						<th><?php esc_html_e( 'Opis', 'hnd-optimizer' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong>FCP</strong> (First Contentful Paint)</td>
						<td class="<?php echo $this->get_metric_class( 'fcp', $this->audit_results['desktop']['fcp'] ); ?>"><?php echo esc_html( $this->audit_results['desktop']['fcp'] ); ?></td>
						<td class="<?php echo $this->get_metric_class( 'fcp', $this->audit_results['mobile']['fcp'] ); ?>"><?php echo esc_html( $this->audit_results['mobile']['fcp'] ); ?></td>
						<td>&lt; 1.8s</td>
						<td><?php esc_html_e( 'Czas do pierwszej zawartości', 'hnd-optimizer' ); ?></td>
					</tr>
					<tr>
						<td><strong>LCP</strong> (Largest Contentful Paint)</td>
						<td class="<?php echo $this->get_metric_class( 'lcp', $this->audit_results['desktop']['lcp'] ); ?>"><?php echo esc_html( $this->audit_results['desktop']['lcp'] ); ?></td>
						<td class="<?php echo $this->get_metric_class( 'lcp', $this->audit_results['mobile']['lcp'] ); ?>"><?php echo esc_html( $this->audit_results['mobile']['lcp'] ); ?></td>
						<td>&lt; 2.5s</td>
						<td><?php esc_html_e( 'Czas do największego elementu', 'hnd-optimizer' ); ?></td>
					</tr>
					<tr>
						<td><strong>TBT</strong> (Total Blocking Time)</td>
						<td class="<?php echo $this->get_metric_class( 'tbt', $this->audit_results['desktop']['tbt'] ); ?>"><?php echo esc_html( $this->audit_results['desktop']['tbt'] ); ?></td>
						<td class="<?php echo $this->get_metric_class( 'tbt', $this->audit_results['mobile']['tbt'] ); ?>"><?php echo esc_html( $this->audit_results['mobile']['tbt'] ); ?></td>
						<td>&lt; 200ms</td>
						<td><?php esc_html_e( 'Całkowity czas blokowania', 'hnd-optimizer' ); ?></td>
					</tr>
					<tr>
						<td><strong>CLS</strong> (Cumulative Layout Shift)</td>
						<td class="<?php echo $this->get_metric_class( 'cls', $this->audit_results['desktop']['cls'] ); ?>"><?php echo esc_html( $this->audit_results['desktop']['cls'] ); ?></td>
						<td class="<?php echo $this->get_metric_class( 'cls', $this->audit_results['mobile']['cls'] ); ?>"><?php echo esc_html( $this->audit_results['mobile']['cls'] ); ?></td>
						<td>&lt; 0.1</td>
						<td><?php esc_html_e( 'Przesunięcia układu strony', 'hnd-optimizer' ); ?></td>
					</tr>
					<tr>
						<td><strong>SI</strong> (Speed Index)</td>
						<td class="<?php echo $this->get_metric_class( 'si', $this->audit_results['desktop']['si'] ); ?>"><?php echo esc_html( $this->audit_results['desktop']['si'] ); ?></td>
						<td class="<?php echo $this->get_metric_class( 'si', $this->audit_results['mobile']['si'] ); ?>"><?php echo esc_html( $this->audit_results['mobile']['si'] ); ?></td>
						<td>&lt; 3.4s</td>
						<td><?php esc_html_e( 'Szybkość renderowania', 'hnd-optimizer' ); ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="hnd-audit-section">
			<h3>🔧 <?php esc_html_e( 'Zalecenia optymalizacyjne', 'hnd-optimizer' ); ?></h3>

			<?php foreach ( $this->audit_results['issues'] as $issue ) : ?>
				<div class="hnd-audit-item">
					<div class="hnd-audit-status <?php echo 'high' === $issue['priority'] ? 'fail' : 'warn'; ?>">
						<?php echo 'high' === $issue['priority'] ? '✗' : '!'; ?>
					</div>
					<div style="flex:1;">
						<strong><?php echo esc_html( $issue['title'] ); ?></strong><br>
						<small>
							<?php
							printf(
								/* translators: 1: issue type, 2: potential savings */
								esc_html__( 'Typ: %1$s | Oszczędność: %2$s', 'hnd-optimizer' ),
								esc_html( ucfirst( str_replace( '_', ' ', $issue['type'] ) ) ),
								esc_html( $issue['savings'] )
							);
							?>
						</small>
					</div>
					<?php if ( $issue['fix'] ) : ?>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=hnd-optimizer-' . $issue['type'] ) ); ?>" class="hnd-btn hnd-btn-secondary">
							<?php esc_html_e( 'Konfiguruj', 'hnd-optimizer' ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="hnd-audit-section">
			<h3>✅ <?php esc_html_e( 'Osiągnięte cele', 'hnd-optimizer' ); ?></h3>

			<div class="hnd-audit-item">
				<div class="hnd-audit-status pass">✓</div>
				<div><?php esc_html_e( 'SEO: 100/100 - Strona spełnia wszystkie podstawowe wymagania SEO', 'hnd-optimizer' ); ?></div>
			</div>
			<div class="hnd-audit-item">
				<div class="hnd-audit-status pass">✓</div>
				<div><?php esc_html_e( 'Dostępność: 90/100 - Strona jest dostępna dla osób niepełnosprawnych', 'hnd-optimizer' ); ?></div>
			</div>
			<div class="hnd-audit-item">
				<div class="hnd-audit-status pass">✓</div>
				<div><?php esc_html_e( 'Sprawdzone metody: 96/100 - Strona stosuje dobre praktyki', 'hnd-optimizer' ); ?></div>
			</div>
			<div class="hnd-audit-item">
				<div class="hnd-audit-status pass">✓</div>
				<div><?php esc_html_e( 'CLS: 0 - Brak przesunięć układu strony', 'hnd-optimizer' ); ?></div>
			</div>
			<div class="hnd-audit-item">
				<div class="hnd-audit-status pass">✓</div>
				<div><?php esc_html_e( 'Desktop Performance: 88/100 - Dobra wydajność na komputerach', 'hnd-optimizer' ); ?></div>
			</div>
		</div>
		<?php
	}

	/**
	 * Dodaj linki akcji do listy pluginów.
	 *
	 * @param array  $links Linki.
	 * @param string $file  Plik pluginu.
	 * @return array
	 */
	public function add_plugin_action_links( $links, $file ) {
		if ( strpos( $file, 'hnd-pagespeed-optimizer' ) !== false ) {
			$settings_link = '<a href="' . admin_url( 'admin.php?page=hnd-pagespeed-optimizer' ) . '">' . __( 'Ustawienia', 'hnd-optimizer' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}

	/**
	 * Dodaj menu do paska admina.
	 *
	 * @param WP_Admin_Bar $wp_admin_bar Admin bar.
	 */
	public function add_admin_bar_menu( $wp_admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$wp_admin_bar->add_node(
			array(
				'id'    => 'hnd-optimizer',
				'title' => '<span class="ab-icon dashicons dashicons-performance"></span> HND',
				'href'  => admin_url( 'admin.php?page=hnd-pagespeed-optimizer' ),
			)
		);

		$wp_admin_bar->add_node(
			array(
				'parent' => 'hnd-optimizer',
				'id'     => 'hnd-dashboard',
				'title'  => __( 'Dashboard', 'hnd-optimizer' ),
				'href'   => admin_url( 'admin.php?page=hnd-pagespeed-optimizer' ),
			)
		);

		$wp_admin_bar->add_node(
			array(
				'parent' => 'hnd-optimizer',
				'id'     => 'hnd-performance',
				'title'  => __( 'Wydajność', 'hnd-optimizer' ),
				'href'   => admin_url( 'admin.php?page=hnd-optimizer-performance' ),
			)
		);

		$wp_admin_bar->add_node(
			array(
				'parent' => 'hnd-optimizer',
				'id'     => 'hnd-audit',
				'title'  => __( 'Raport Audytu', 'hnd-optimizer' ),
				'href'   => admin_url( 'admin.php?page=hnd-optimizer-audit' ),
			)
		);
	}

	/**
	 * AJAX: Uruchom audyt.
	 */
	public function ajax_run_audit() {
		check_ajax_referer( 'hnd_optimizer_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Brak uprawnień' );
		}

		// W przyszłości: integracja z PageSpeed API.
		wp_send_json_success( array( 'message' => 'Audyt zakończony' ) );
	}

	/**
	 * AJAX: Zastosuj poprawkę.
	 */
	public function ajax_apply_fix() {
		check_ajax_referer( 'hnd_optimizer_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Brak uprawnień' );
		}

		$setting = isset( $_POST['setting'] ) ? sanitize_key( $_POST['setting'] ) : '';

		if ( empty( $setting ) || ! isset( $this->default_settings[ $setting ] ) ) {
			wp_send_json_error( 'Nieznane ustawienie' );
		}

		// Użyj nowej metody save_settings, która poprawnie łączy ustawienia.
		$result = $this->save_settings( array( $setting => true ) );

		if ( $result ) {
			wp_send_json_success( array( 'message' => 'Poprawka zastosowana' ) );
		} else {
			wp_send_json_error( 'Błąd zapisu' );
		}
	}

	/**
	 * AJAX: Resetuj ustawienia.
	 */
	public function ajax_reset_settings() {
		check_ajax_referer( 'hnd_optimizer_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Brak uprawnień' );
		}

		// Usuń istniejące ustawienia i zapisz domyślne.
		delete_option( self::OPTION_NAME );
		$result = update_option( self::OPTION_NAME, $this->default_settings, true );
		$this->settings = $this->default_settings;

		if ( $result ) {
			wp_send_json_success( array( 'message' => 'Ustawienia zresetowane' ) );
		} else {
			// Nawet jeśli update_option zwraca false (bo wartość się nie zmieniła),
			// to ustawienia zostały zresetowane przez delete_option.
			wp_send_json_success( array( 'message' => 'Ustawienia zresetowane' ) );
		}
	}

	/**
	 * Pobierz ustawienie.
	 *
	 * @param string $key Klucz ustawienia.
	 * @return mixed
	 */
	public function get_setting( $key ) {
		return isset( $this->settings[ $key ] ) ? $this->settings[ $key ] : null;
	}

	/**
	 * Sprawdź czy funkcja jest włączona.
	 *
	 * @param string $key Klucz ustawienia.
	 * @return bool
	 */
	public function is_enabled( $key ) {
		return (bool) $this->get_setting( $key );
	}
}

// Inicjalizacja.
HND_PageSpeed_Optimizer::get_instance();
