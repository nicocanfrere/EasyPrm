<?php

namespace Application\Api\ProductCatalog\Dto;

/**
 * Class PriceInputDto
 */
class PriceInputDto
{
    /** @var string|null */
    private $label;
    /** @var int|float|null */
    private $amount;
    /** @var string|null */
    private $currency;
    /** @var string|null */
    private $identifier;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): PriceInputDto
    {
        $this->label = $label;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): PriceInputDto
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): PriceInputDto
    {
        $this->currency = $currency;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): PriceInputDto
    {
        $this->identifier = $identifier;

        return $this;
    }
}
