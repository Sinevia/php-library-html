<?php

namespace Sinevia\Html;

class Utils {

    /**
     * Checks if a string ends with another string
     * $result = Utils::stringEndsWith("http://server.com",".com");
     * // $result is true
     * </code>
     * @return bool true on success, false otherwise
     */
    public static function stringEndsWith($string, $match) {
        return (substr($string, (strlen($string) - strlen($match)), strlen($match)) == $match) ? true : false;
    }

}
