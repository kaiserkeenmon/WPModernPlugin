<?php

/**
 * Plugin Name: WPModernPlugin
 * Description: A modern plugin starter with PSR-4 autoloading, lazy DI, and auto-instantiation.
 * Version: 1.00
 * Author: Kaiser Keenmon
 */

// Register the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

// Import the DI Container class.
use WPModernPlugin\Container\Container;

// Initialize the DI Container.
$container = new Container();

// Load the class registration file.
$classes = require __DIR__ . '/src/registration.php';

// Register classes with the container.
foreach ($classes as $class => $path) {
    if (is_string($path)) {
        // It's a path, require it directly (useful for non-namespaced classes)
        require_once $path;
    } else {
        // It's a class name; register it in the DI container for lazy loading
        // Assuming $container->register() exists and handles lazy loading setup
        $container->register($class);
    }
}

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
