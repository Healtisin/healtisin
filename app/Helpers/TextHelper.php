<?php

namespace App\Helpers;

class TextHelper
{
    public static function truncate($text, $length = 50)
    {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '...';
    }
} 