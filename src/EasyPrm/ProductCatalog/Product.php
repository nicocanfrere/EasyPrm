<?php

namespace EasyPrm\ProductCatalog;

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
    /** @var PriceInterface[]|null */
    private $prices;

    public function __construct(
        Identifier $identifier,
        string $label
    ) {
        $this->identifier = $identifier;
        $this->label = $label;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getPrices(): ?array
    {
        return $this->prices;
    }
}
