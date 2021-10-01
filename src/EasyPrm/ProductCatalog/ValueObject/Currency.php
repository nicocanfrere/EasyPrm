<?php

namespace EasyPrm\ProductCatalog\ValueObject;

use EasyPrm\ProductCatalog\Exception\InvalidCurrencyException;

/**
 * Class Currency
 */
class Currency
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): Currency
    {
        $value = strtoupper(trim(strip_tags($value)));
        if (!self::isValid($value)) {
            throw new InvalidCurrencyException($value);
        }

        return new static($value);
    }

    public static function isValid(string $value): bool
    {
        return !!preg_match('/^[A-Z]{3}$/', $value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Currency $other): bool
    {
        return $other->getValue() === $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
