<?php

namespace EasyPrm\ProductCatalog;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\Contract\ProductInterface;

/**
 * Class Product
 */
class Product implements ProductInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var string|null */
    private $label;
    /** @var string|null */
    private $alias;
    /** @var PriceInterface[]|Collection|null */
    private $prices;

    public function __construct(
        Identifier $identifier,
        string $label,
        string $alias
    ) {
        $this->identifier = $identifier;
        $this->label = $label;
        $this->alias = $alias;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
        $this->prices = new ArrayCollection();
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getPrices(): ?Collection
    {
        return $this->prices;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setLabel(?string $label): ProductInterface
    {
        $this->label = $label;

        return $this;
    }

    public function setAlias(?string $alias): ProductInterface
    {
        $this->alias = $alias;

        return $this;
    }

    public function addPrice(PriceInterface $price): ProductInterface
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
        }

        return $this;
    }

    public function removePrice(PriceInterface $price): ProductInterface
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
        }

        return $this;
    }
}
