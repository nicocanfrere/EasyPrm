<?php

namespace EasyPrm\ProductCatalog\ValueObject;

use EasyPrm\ProductCatalog\Exception\InvalidAmountException;

/**
 * Class Amount
 */
class Amount
{
    public const PRECISION = 1000000;
    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create($value, bool $isRaw = false): Amount
    {
        if (!self::isValid($value)) {
            throw new InvalidAmountException();
        }
        $value = $isRaw ? $value : self::transform($value);

        return new static($value);
    }

    public static function fromRawValue($value): Amount
    {
        if (!is_int($value) || abs($value) >= PHP_INT_MAX) {
            throw new InvalidAmountException();
        }

        return self::create($value, true);
    }

    public static function isValid($value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }
        if (PHP_INT_MAX <= abs($value * self::PRECISION)) {
            return false;
        }

        return true;
    }

    public static function transform($value)
    {
        return $value * self::PRECISION;
    }

    public static function reverseTransform(int $value)
    {
        return $value / self::PRECISION;
    }

    public function getValue()
    {
        return self::reverseTransform($this->value);
    }

    public function getRawValue(): int
    {
        return $this->value;
    }

    public function equals(Amount $other): bool
    {
        return $other->getRawValue() === $this->value;
    }
}
