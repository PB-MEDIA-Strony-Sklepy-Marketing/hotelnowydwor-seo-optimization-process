<?php

/**
 * Plugin Name: Oxygen Attributes
 * Plugin URI: https://www.cleanplugins.com/products/oxygen-attributes/
 * Description: A useful plugin to add custom attributes to Oxygen components
 * Version: 1.3.5
 * Update URI: https://api.freemius.com
 * Requires PHP: 7.0
 * Requires at least: 5.0
 * Author: Clean Plugins
 * Author URI: https://www.cleanplugins.com/
 */

use ERROPIX\OxygenAttributes\AttributesManager;

// don't load directly
if (!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

// Plugin constants
define('OXYATTR_BASE', plugin_basename(__FILE__));
define('OXYATTR_URL', plugin_dir_url(__FILE__));
define('OXYATTR_DIR', plugin_dir_path(__FILE__));

// Require autoloader
require OXYATTR_DIR . 'vendor/autoload.php';

// Load the plugin class
new AttributesManager();
