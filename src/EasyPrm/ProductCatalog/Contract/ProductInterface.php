<?php

namespace EasyPrm\ProductCatalog\Contract;

use Doctrine\Common\Collections\Collection;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Interface ProductInterface
 */
interface ProductInterface
{

    public function getAlias(): ?string;

    public function getLabel(): ?string;

    public function getPrices(): ?Collection;

    public function getIdentifier(): ?Identifier;

    public function setLabel(?string $label): ProductInterface;

    public function setAlias(?string $alias): ProductInterface;

    public function removePrice(PriceInterface $price): ProductInterface;

    public function addPrice(PriceInterface $price): ProductInterface;
}
