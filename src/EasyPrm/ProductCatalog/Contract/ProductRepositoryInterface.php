<?php


namespace EasyPrm\ProductCatalog\Contract;

/**
 * Interface ProductRepositoryInterface
 */
interface ProductRepositoryInterface
{
    public function save(ProductInterface $product): void;

    public function remove(ProductInterface $product): void;

    public function oneByIdentifier($identifier): ?ProductInterface;

    public function oneByLabel(string $label): ?ProductInterface;
}
