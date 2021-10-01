<?php


namespace EasyPrm\Core\Contract;

/**
 * Interface TransliteratorInterface
 */
interface TransliteratorInterface
{
    public function transliterate(string $string, ?string $separator = '-'): string;
}
