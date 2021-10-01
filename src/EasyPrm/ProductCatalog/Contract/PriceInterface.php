<?php

namespace EasyPrm\ProductCatalog\Contract;

use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Price;
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
}
