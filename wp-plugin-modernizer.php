<?php

/**
 * Plugin Name: WPPluginModernizer
 * Description: A modern plugin starter with PSR-4 autoloading, lazy DI, and auto-instantiation.
 * Version: 1.0.1
 * Author: Kaiser Keenmon
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Register the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

// Import the DI Container class.
use WPPluginModernizer\Container\Container;

// Load the class registration file.
$registrations = require __DIR__ . '/src/registration.php';

// Initialize the DI Container.
$container = Container::getInstance($registrations);

// Plugin Activation
register_activation_hook(__FILE__, function () use ($container) {
    // Perform plugin activation tasks here.
});

// Plugin Deactivation
register_deactivation_hook(__FILE__, function () {
    // Perform plugin deactivation tasks here.
});

// Hooks and filters registration
add_action('init', function () use ($container) {
    // Initialize your plugin components here
    // Example: $container->get('YourPlugin\Service\SomeService')->init();
});
