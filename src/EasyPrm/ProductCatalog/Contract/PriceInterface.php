<?php

namespace EasyPrm\ProductCatalog\Contract;

use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use EasyPrm\ProductCatalog\ValueObject\Currency;

/**
 * Interface PriceInterface
 */
interface PriceInterface
{

    public function getCurrency(): ?Currency;

    public function getLabel(): ?string;

    public function getAmount(): ?Amount;

    public function getIdentifier(): ?Identifier;

    public function getAlias(): ?string;

    public function setAmount(?Amount $amount): PriceInterface;

    public function setLabel(?string $label): PriceInterface;

    public function setCurrency(?Currency $currency): PriceInterface;

    public function setAlias(?string $alias): PriceInterface;
}
