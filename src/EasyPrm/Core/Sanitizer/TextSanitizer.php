<?php

namespace EasyPrm\Core\Sanitizer;

/**
 * Class TextSanitizer
 */
class TextSanitizer
{
    public static function sanitize(?string $string = null): ?string
    {
        return preg_replace("/\s\s+/", " ", trim(strip_tags($string)));
    }
}
