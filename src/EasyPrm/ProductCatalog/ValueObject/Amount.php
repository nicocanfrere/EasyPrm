<?php

namespace EasyPrm\ProductCatalog\ValueObject;

use EasyPrm\ProductCatalog\Exception\InvalidAmountException;

/**
 * Class Amount
 */
final class Amount
{
    public const PRECISION = 1000000;
    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param int|float $value
     * @param bool $isRaw
     *
     * @return Amount
     */
    public static function create($value, bool $isRaw = false): Amount
    {
        if (!self::isValid($value)) {
            throw new InvalidAmountException();
        }
        $value = $isRaw ? $value : self::transform($value);

        return new static($value);
    }

    public static function fromRawValue(int $value): Amount
    {
        if (!is_int($value) || abs($value) >= PHP_INT_MAX) {
            throw new InvalidAmountException();
        }

        return self::create($value, true);
    }

    /**
     * @param int|float $value
     *
     * @return bool
     */
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

    /**
     * @param int|float $value
     *
     * @return float|int
     */
    public static function transform($value)
    {
        return $value * self::PRECISION;
    }

    /**
     * @param int $value
     *
     * @return float|int
     */
    public static function reverseTransform(int $value)
    {
        return $value / self::PRECISION;
    }

    /**
     * @return float|int
     */
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
