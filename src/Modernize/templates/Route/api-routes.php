<?php

/**
 * Project: WPPluginModernizer
 * File: RepositoryTemplate.php
 * Author: WPPluginModernizer
 * Date: 3/5/24
 */

$template = <<<TEMPLATE
<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

add_action('plugins_loaded', function () {
    \$container = WPPluginModernizer\Container\Container::getInstance();

    add_action('rest_api_init', function () use (\$container) {
        \$service = \$container->get({{pluginDirName}}\Service\YourServiceInterface::class);

        register_rest_route('your-plugin/v1', '/resource', array(
            'methods' => 'GET',
            'callback' => function (\$request) use (\$service) {
                // Directly use the service to handle the request.
                // \$data = \$service->fetchData();
                // return new WP_REST_Response(\$data, 200);
            },
            'permission_callback' => '__return_true'
        ));

        // Additional routes...
    });
});
TEMPLATE;

return $template;
