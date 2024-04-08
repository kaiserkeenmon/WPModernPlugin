<?php

/**
 * Project: WPPluginModernizer
 * File: RepositoryTemplate.php
 * Author: WPPluginModernizer
 * Date: 4/7/24
 */

$template = <<<TEMPLATE
<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

add_action('rest_api_init', function () {
    register_rest_route('your-plugin/v1', '/resource', array(
        'methods' => 'GET',
        'callback' => function (\$request) {
            // Use the service to handle the request.
            // Directly use the service to handle the request.
            // \$data = \$service->fetchData();
            // return new WP_REST_Response(\$data, 200);
        },
        'permission_callback' => '__return_true'
    ));
});
TEMPLATE;

return $template;
