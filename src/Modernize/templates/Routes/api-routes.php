<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Assuming you have a way to get your container instance to fetch the service.
$container = YourCamelCasedPluginDirectoryName\Container\Container::getInstance();

add_action('rest_api_init', function () use ($container) {
    $service = $container->get(YourCamelCasedPluginDirectoryName\Service\YourServiceInterface::class);

    register_rest_route('your-plugin/v1', '/resource', array(
        'methods' => 'GET',
        'callback' => function ($request) use ($service) {
            // Directly use the service to handle the request.
            $data = $service->fetchData();
            return new WP_REST_Response($data, 200);
        },
    ));

    // Add more routes as needed.
});
