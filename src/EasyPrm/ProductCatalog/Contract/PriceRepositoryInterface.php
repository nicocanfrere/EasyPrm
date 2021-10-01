<?php


namespace EasyPrm\ProductCatalog\Contract;

/**
 * Interface PriceRepositoryInterface
 */
interface PriceRepositoryInterface
{
    public function save(PriceInterface $price): void;

    public function remove(PriceInterface $price): void;

    public function oneByIdentifier($identifier): ?PriceInterface;

    public function oneByLabel(string $label): ?PriceInterface;
}
