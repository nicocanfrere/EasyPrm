<?php

namespace EasyPrm\ProductCatalog\Contract;

use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Product;

/**
 * Interface ProductInterface
 */
interface ProductInterface
{

    public function getAlias(): ?string;

    public function getLabel(): ?string;

    public function getPrices(): ?array;

    public function getIdentifier(): ?Identifier;

    public function setLabel(?string $label): ProductInterface;

    public function setAlias(?string $alias): ProductInterface;
}
