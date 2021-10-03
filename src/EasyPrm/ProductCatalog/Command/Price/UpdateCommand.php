<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\Sanitizer\TextSanitizer;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class UpdateCommand
 */
class UpdateCommand
{
    /** @var string|null */
    private $label;
    /** @var mixed */
    private $amount;
    /** @var string|null */
    private $currency;
    /** @var Identifier|null */
    private $identifier;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): UpdateCommand
    {
        $this->label = TextSanitizer::sanitize($label);

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): UpdateCommand
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): UpdateCommand
    {
        $this->currency = TextSanitizer::sanitize($currency);

        return $this;
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function setIdentifier(?Identifier $identifier): UpdateCommand
    {
        $this->identifier = $identifier;

        return $this;
    }
}
