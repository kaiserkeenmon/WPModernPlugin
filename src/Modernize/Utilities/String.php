<?php

/**
 * Project: WPModernPlugin
 * File: StringUtils.php
 * Author: Kaiser Keenmon
 * Date: 3/7/24
 */

namespace Modernize\Utilities;

class String {
    /**
     * Converts a hyphenated string to CamelCase.
     *
     * @param string $string The hyphenated string.
     * @return string The CamelCase string.
     */
    public static function hyphenToCamelCase(string $string): string {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        return $str;
    }
}
