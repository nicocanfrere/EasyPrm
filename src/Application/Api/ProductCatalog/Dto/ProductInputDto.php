<?php

namespace Application\Api\ProductCatalog\Dto;

/**
 * Class ProductInputDto
 */
class ProductInputDto
{
    /** @var string|null */
    private $label;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): ProductInputDto
    {
        $this->label = $label;

        return $this;
    }
}
