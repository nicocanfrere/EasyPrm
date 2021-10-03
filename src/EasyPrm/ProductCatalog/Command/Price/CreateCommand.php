<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\Sanitizer\TextSanitizer;

/**
 * Class CreateCommand
 */
class CreateCommand
{
    /** @var string|null */
    private $label;
    /** @var mixed */
    private $amount;
    /** @var string|null */
    private $currency;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): CreateCommand
    {
        $this->label = TextSanitizer::sanitize($label);

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): CreateCommand
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): CreateCommand
    {
        $this->currency = TextSanitizer::sanitize($currency);

        return $this;
    }
}
