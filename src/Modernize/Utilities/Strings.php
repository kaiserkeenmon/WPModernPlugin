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

    public static function sanitizeTitleWithDashes($title) {
    // Lowercase the string
    $title = strtolower($title);

    // Replace spaces with dashes
    $title = str_replace(' ', '-', $title);

    // Remove characters that are not alphanumeric or dashes
    $title = preg_replace('/[^a-z0-9-]/', '', $title);

    // Replace multiple dashes with a single dash
    $title = preg_replace('/-+/', '-', $title);

    // Trim dashes from the beginning and end of the string
    $title = trim($title, '-');

    return $title;
}
}
