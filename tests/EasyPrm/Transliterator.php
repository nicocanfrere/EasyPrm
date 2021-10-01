<?php

namespace EasyPrm\Tests;

use Behat\Transliterator\Transliterator as TransliteratorUtil;
use EasyPrm\Core\Contract\TransliteratorInterface;

/**
 * Class Transliterator
 */
class Transliterator implements TransliteratorInterface
{
    public function transliterate(string $string, ?string $separator = '-'): string
    {
        return TransliteratorUtil::urlize(TransliteratorUtil::transliterate($string, $separator));
    }
}
