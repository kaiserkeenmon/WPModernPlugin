<?php

/**
 * Project: WPPluginModernizer
 * File: StringUtils.php
 * Author: WPPluginModernizer
 * Date: 3/7/24
 */

namespace WPPluginModernizer\Modernize\Utilities;

class Strings {

    /**
     * Converts a hyphenated string to CamelCase.
     *
     * @param String $string The hyphenated string.
     * @return string The CamelCase string.
     */
    public static function hyphenToCamelCase(String $string): string {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        return $str;
    }

    public static function sanitizeAndConvertToCamelCase($title) {
        $title = str_replace(['-', '_'], ' ', $title);
        $title = ucwords($title);
        $title = str_replace(' ', '', $title);
        return $title;
    }
}
