<?php

/**
 * Project: WPPluginModernizer
 * File: wp-bootstrap.php
 * Author: Kaiser Keenmon
 * Date: 4/2/24
 */

namespace WPPluginModernizer\Modernize;

class WPBootstrap {

    /**
     * @return void
     */
    public static function init() {
        $wpLoadPath = dirname(__DIR__, 6) . '/wp-load.php';
        if (file_exists($wpLoadPath)) {
            require_once $wpLoadPath;
        } else {
            throw new \Exception("Failed to initialize WordPress environment.");
        }
    }
}
