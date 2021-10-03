<?php

namespace EasyPrm\ProductCatalog\Command\Product;

/**
 * Class CreateCommand
 */
class CreateCommand
{
    /** @var string|null */
    private $label;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): CreateCommand
    {
        $this->label = $label;

        return $this;
    }
}
