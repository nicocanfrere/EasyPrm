<?php

namespace EasyPrm\ProductCatalog\Contract;

use EasyPrm\ProductCatalog\Factory\PriceFactory;
use EasyPrm\ProductCatalog\Price;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use EasyPrm\ProductCatalog\ValueObject\Currency;

/**
 * Interface PriceFactoryInterface
 */
interface PriceFactoryInterface
{

    public function create(string $label, $amount, string $currency): PriceInterface;
}
