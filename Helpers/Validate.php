<?php

namespace Helpers;

use \Exceptions\RssException;

class Validate
{

    /**
     * @param  string  $title
     * @param  string  $value
     * @param  array  $array
     *
     * @throws \Exceptions\RssException
     */
    public static function inArray(string $title, string $value, array $array) {
        if (!in_array($value, $array)) {

            $error = "{$title} - {$value} must be one of these values: " . implode(', ', $array);
            throw new RssException($error);
        }
    }
}