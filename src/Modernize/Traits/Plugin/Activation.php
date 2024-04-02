<?php

/**
 * Project: WPPluginModernizer
 * File: Activation.php
 * Author: Kaiser Keenmon
 * Date: 4/1/24
 */

namespace WPPluginModernizer\Modernize\Traits\Plugin;

trait Activation {
    public function ensurePluginActivated() {
        $active_plugins = get_option('active_plugins');
        $plugin_path = 'WPPluginModernizer/wp-plugin-modernizer.php';

        if (!in_array($plugin_path, $active_plugins)) {
            throw new \Exception("WPPluginModernizer is not activated.");
        }
    }
}

