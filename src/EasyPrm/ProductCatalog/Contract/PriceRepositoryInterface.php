<?php

namespace EasyPrm\ProductCatalog\Contract;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Interface PriceRepositoryInterface
 */
interface PriceRepositoryInterface
{
    public function save(PriceInterface $price): void;

    public function remove(PriceInterface $price): void;

    public function oneByIdentifier(Identifier $identifier): ?PriceInterface;

    public function oneByLabel(string $label): ?PriceInterface;
}
