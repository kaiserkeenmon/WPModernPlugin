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

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Load the DI container.
require_once dirname(__FILE__, 2) . '/WPPluginModernizer/src/Container/Container.php';

// Load Composer autoloader.
require __DIR__ . '/vendor/autoload.php';



