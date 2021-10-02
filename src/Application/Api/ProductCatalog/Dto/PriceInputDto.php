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
    public $amount;
    /** @var string|null */
    public $currency;

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     *
     * @return PriceInputDto
     */
    public function setLabel(?string $label): PriceInputDto
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float|int|null $amount
     *
     * @return PriceInputDto
     */
    public function setAmount($amount): PriceInputDto
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     *
     * @return PriceInputDto
     */
    public function setCurrency(?string $currency): PriceInputDto
    {
        $this->currency = $currency;

        return $this;
    }
}
