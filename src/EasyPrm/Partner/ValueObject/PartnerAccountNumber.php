<?php

namespace EasyPrm\Partner\ValueObject;

/**
 * Class PartnerAccountNumber
 */
final class PartnerAccountNumber
{
    /** @var string */
    private $value;

    /**
     * PartnerAccountNumber constructor.
     *
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): PartnerAccountNumber
    {
        return new self($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(PartnerAccountNumber $other): bool
    {
        return $other->getValue() === $this->getValue();
    }

    public function __toString()
    {
        return $this->value;
    }
}
