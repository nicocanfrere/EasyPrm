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
    /** @var string|null */
    private $alias;
    /** @var Amount|null */
    private $amount;
    /** @var Currency|null */
    private $currency;

    /**
     * Price constructor.
     *
     * @param Identifier $identifier
     * @param string $label
     * @param string $alias
     * @param Amount $amount
     * @param Currency $currency
     */
    public function __construct(
        Identifier $identifier,
        string $label,
        string $alias,
        Amount $amount,
        Currency $currency
    ) {
        $this->identifier = $identifier;
        $this->label      = $label;
        $this->alias      = $alias;
        $this->amount     = $amount;
        $this->currency   = $currency;
        $this->createdAt  = new \DateTimeImmutable();
        $this->updatedAt  = new \DateTime();
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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setLabel(?string $label): PriceInterface
    {
        $this->label = $label;

        return $this;
    }

    public function setAlias(?string $alias): PriceInterface
    {
        $this->alias = $alias;

        return $this;
    }

    public function setAmount(?Amount $amount): PriceInterface
    {
        $this->amount = $amount;

        return $this;
    }

    public function setCurrency(?Currency $currency): PriceInterface
    {
        $this->currency = $currency;

        return $this;
    }
}
