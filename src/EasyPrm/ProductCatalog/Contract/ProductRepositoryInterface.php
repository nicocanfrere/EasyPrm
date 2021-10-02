<?php

namespace EasyPrm\ProductCatalog\Contract;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Interface ProductRepositoryInterface
 */
interface ProductRepositoryInterface
{
    public function save(ProductInterface $product): void;

    public function remove(ProductInterface $product): void;

    public function oneByIdentifier(Identifier $identifier): ?ProductInterface;

    public function oneByLabel(string $label): ?ProductInterface;
}
