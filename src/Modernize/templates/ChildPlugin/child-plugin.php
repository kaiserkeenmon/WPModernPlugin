<?php

/**
 * Plugin Name: Template Plugin Name
 * Plugin URI: http://yourpluginurl.com
 * Description: A brief description of the plugin.
 * Version: 1.0
 * Author: Your Name
 * Author URI: http://yourwebsite.com
 * License: GPL2
 */

if ( !defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
\Dotenv\Dotenv::createImmutable(__DIR__)->load();

// Import the DI Container class.
use WPPluginModernizer\Container\Container;

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('WPPluginModernizer/wp-plugin-modernizer.php')) {
    // Require the parent plugin autoloader
    $parentPluginAutoloader = WP_PLUGIN_DIR . '/WPPluginModernizer/vendor/autoload.php';
    if (file_exists($parentPluginAutoloader)) {
        require_once $parentPluginAutoloader;
    } else {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>';
            echo 'The vendor-air-quality plugin requires the WPPluginModernizer plugin to be installed or updated.';
            echo '</p></div>';
        });
    }

    if (class_exists(Container::class)) {
        // Load the class registration file and initialize the DI Container with child plugin registrations.
        $registrations = require __DIR__ . '/src/registration.php';
        $container = Container::getInstance($registrations);
    } else {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>';
            echo 'The vendor-air-quality plugin requires the WPPluginModernizer plugin to be updated.';
            echo '</p></div>';
        });

    }
} else {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error"><p>';
        echo 'The vendor-air-quality plugin requires the WPPluginModernizer plugin to be active.';
        echo '</p></div>';
    });

}



