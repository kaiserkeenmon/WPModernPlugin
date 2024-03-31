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

    /**
     * @param $title
     * @return string
     */
    public static function sanitizeTitleWithDashes($title) {
        $title = strtolower($title);
        $title = str_replace(' ', '-', $title);
        $title = preg_replace('/[^a-z0-9-]/', '', $title);
        $title = preg_replace('/-+/', '-', $title);
        $title = trim($title, '-');
        return $title;
    }

    /**
     * @param $title
     * @return array|string|string[]
     */
    public static function sanitizeAndConvertToCamelCase($title) {
        $title = str_replace(['-', '_'], ' ', $title);
        $title = ucwords($title);
        $title = str_replace(' ', '', $title);
        return $title;
    }
}
