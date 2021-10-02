<?php

namespace EasyPrm\ProductCatalog\Contract;

use EasyPrm\ProductCatalog\Factory\ProductFactory;
use EasyPrm\ProductCatalog\Product;

/**
 * Interface ProductFactoryInterface
 */
interface ProductFactoryInterface
{

    public function create(string $label): ProductInterface;
}
