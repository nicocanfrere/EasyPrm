<?php

namespace Application\Api\ProductCatalog\Dto;

/**
 * Class ProductInputDto
 */
class ProductInputDto
{
    /** @var string|null */
    private $label;
    /** @var string|null */
    private $identifier;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): ProductInputDto
    {
        $this->label = $label;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): ProductInputDto
    {
        $this->identifier = $identifier;

        return $this;
    }
}
