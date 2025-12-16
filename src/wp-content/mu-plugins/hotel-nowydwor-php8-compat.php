<?php
/**
 * Hotel Nowy Dwór - PHP 8.x Compatibility Fixes
 *
 * Must-use plugin that handles PHP 8.x deprecation warnings and
 * compatibility issues in third-party plugins.
 *
 * This plugin uses a custom error handler to suppress specific
 * deprecation warnings from vendor libraries that cannot be modified.
 *
 * @package    HotelNowyDwor
 * @subpackage PHP8Compat
 * @author     PB MEDIA
 * @version    1.0.0
 * @since      1.0.0
 *
 * Plugin Name: Hotel Nowy Dwór PHP 8.x Compatibility
 * Plugin URI:  https://www.hotelnowydwor.eu/
 * Description: Handles PHP 8.x deprecation warnings from third-party plugins.
 * Version:     1.0.0
 * Author:      PB MEDIA
 * Author URI:  https://pb-media.pl/
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom error handler to suppress known deprecation warnings.
 *
 * Only suppresses specific vendor warnings that cannot be fixed
 * without modifying third-party plugin code.
 *
 * @param int    $errno   Error level.
 * @param string $errstr  Error message.
 * @param string $errfile File where error occurred.
 * @param int    $errline Line number of error.
 *
 * @return bool Whether to continue with internal handler.
 */
function hotel_nowydwor_error_handler( $errno, $errstr, $errfile, $errline ) {
	// Only handle deprecation warnings.
	if ( E_DEPRECATED !== $errno && E_USER_DEPRECATED !== $errno ) {
		return false;
	}

	// Patterns of vendor files with known PHP 8.x deprecation issues.
	$suppressed_patterns = array(
		// Freemius SDK - implicit nullable parameter deprecations.
		'freemius/wordpress-sdk/includes/class-freemius.php',
		// Yoast SEO vendor libraries.
		'wordpress-seo/vendor_prefixed/league/oauth2-client',
		'wordpress-seo/vendor_prefixed/guzzlehttp/guzzle',
		// OxyExtras vendor.
		'oxyextras/vendor',
	);

	// Specific error messages to suppress.
	$suppressed_messages = array(
		'Implicitly marking parameter',
		'Passing null to parameter',
	);

	// Check if file matches suppressed patterns.
	foreach ( $suppressed_patterns as $pattern ) {
		if ( false !== strpos( $errfile, $pattern ) ) {
			// Log to debug.log but don't display.
			if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG && defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				// Reduced logging - only log first occurrence per hour.
				$cache_key = 'hnd_err_' . md5( $errfile . $errline );
				if ( false === get_transient( $cache_key ) ) {
					error_log( "[Hotel Nowy Dwór PHP8 Compat] Suppressed: {$errstr} in {$errfile}:{$errline}" );
					set_transient( $cache_key, 1, HOUR_IN_SECONDS );
				}
			}
			return true; // Suppress the error.
		}
	}

	// Check message patterns.
	foreach ( $suppressed_messages as $message ) {
		if ( false !== strpos( $errstr, $message ) ) {
			// These are typically safe to suppress.
			return true;
		}
	}

	// Let WordPress handle all other errors.
	return false;
}

/**
 * Initialize custom error handler early in the WordPress load.
 */
function hotel_nowydwor_init_error_handler() {
	// Only set custom handler if WP_DEBUG is enabled.
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		set_error_handler( 'hotel_nowydwor_error_handler', E_DEPRECATED | E_USER_DEPRECATED );
	}
}

// Initialize immediately.
hotel_nowydwor_init_error_handler();

/**
 * Filter to prevent "headers already sent" errors from showing.
 *
 * This happens when deprecation notices are echoed before headers are sent.
 */
add_action(
	'plugins_loaded',
	function () {
		// Start output buffering early to catch any stray output.
		if ( ! headers_sent() && ! defined( 'DOING_AJAX' ) && ! defined( 'WP_CLI' ) ) {
			ob_start();
		}
	},
	-9999
);

/**
 * Clean output buffer before sending headers.
 */
add_action(
	'send_headers',
	function () {
		// Flush and clean output buffer if it contains only whitespace/errors.
		if ( ob_get_level() > 0 ) {
			$output = ob_get_contents();
			// If output is only deprecation notices, discard it.
			if ( preg_match( '/^(\s*(Deprecated|Warning|Notice):.*\n?)+$/s', $output ) ) {
				ob_clean();
			}
		}
	},
	1
);

/**
 * Polyfill for functions that may receive null in PHP 8.x.
 *
 * Adds filters to common WordPress functions to handle null values.
 */
add_filter(
	'sanitize_title',
	function ( $title ) {
		return $title ?? '';
	},
	1
);

add_filter(
	'sanitize_file_name',
	function ( $filename ) {
		return $filename ?? '';
	},
	1
);

/**
 * Admin notice when running on PHP 8.2+.
 */
add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Only show notice once per day.
		$notice_key = 'hnd_php8_notice_dismissed';
		if ( get_transient( $notice_key ) ) {
			return;
		}

		$php_version = phpversion();
		if ( version_compare( $php_version, '8.2', '>=' ) ) {
			echo '<div class="notice notice-info is-dismissible">';
			echo '<p><strong>Hotel Nowy Dwór:</strong> ';
			/* translators: %s: PHP version */
			printf(
				esc_html__(
					'Running on PHP %s. Some plugins may show deprecation warnings. The PHP 8.x Compatibility plugin is suppressing known issues.',
					'hotel-nowydwor'
				),
				esc_html( $php_version )
			);
			echo '</p></div>';

			set_transient( $notice_key, 1, DAY_IN_SECONDS );
		}
	}
);
