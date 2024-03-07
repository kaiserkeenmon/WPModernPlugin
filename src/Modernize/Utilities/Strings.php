<?php

/**
 * Project: WPModernPlugin
 * File: StringUtils.php
 * Author: Kaiser Keenmon
 * Date: 3/7/24
 */

namespace Modernize\Utilities;

class Strings {
    /**
     * Converts a hyphenated string to CamelCase.
     *
     * @param Strings $string The hyphenated string.
     * @return Strings The CamelCase string.
     */
    public static function hyphenToCamelCase(Strings $string): Strings {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        return $str;
    }
}
