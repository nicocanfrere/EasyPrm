<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Sanitizer\TextSanitizer;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Contract\ProductInterface;

/**
 * Class UpdateCommand
 */
class UpdateCommand
{
    /** @var string|null */
    public $label;
    /** @var Identifier|null */
    public $identifier;
    /** @var ProductInterface|null */
    public $product;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): UpdateCommand
    {
        $this->label = TextSanitizer::sanitize($label);

        return $this;
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function setIdentifier(?Identifier $identifier): UpdateCommand
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getProduct(): ?ProductInterface
    {
        return $this->product;
    }

    public function setProduct(?ProductInterface $product): UpdateCommand
    {
        $this->product = $product;

        return $this;
    }
}
