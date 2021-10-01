<?php

namespace EasyPrm\ProductCatalog;

use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use EasyPrm\ProductCatalog\ValueObject\Currency;

/**
 * Class Price
 */
class Price implements PriceInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var string|null */
    private $label;
    /** @var Amount|null */
    private $amount;
    /** @var Currency|null */
    private $currency;

    /**
     * Price constructor.
     *
     * @param Identifier $identifier
     * @param string $label
     * @param Amount $amount
     * @param Currency $currency
     */
    public function __construct(Identifier $identifier, string $label, Amount $amount, Currency $currency)
    {
        $this->identifier = $identifier;
        $this->label      = $label;
        $this->amount     = $amount;
        $this->currency   = $currency;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }


    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }
}
