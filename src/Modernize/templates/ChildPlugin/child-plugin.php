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

// Import the DI Container class from WPPluginModernizer.
use WPPluginModernizer\Container\Container;

// Load the class registration file.
$registrations = require __DIR__ . '/src/registration.php';

// Initialize the DI Container.
$container = Container::getInstance($registrations);

// Load Composer autoloader.
require __DIR__ . '/vendor/autoload.php';



