<?php

namespace EasyPrm\Core\ValueObject;

/**
 * Class Identifier
 */
final class Identifier
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): Identifier
    {
        return new static($value);
    }

    public function equals(Identifier $other): bool
    {
        return $other->getValue() === $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
