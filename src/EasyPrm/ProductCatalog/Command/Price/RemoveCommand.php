<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class RemoveCommand
 */
class RemoveCommand
{
    /** @var Identifier|null */
    private $identifier;

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function setIdentifier(?Identifier $identifier): RemoveCommand
    {
        $this->identifier = $identifier;

        return $this;
    }
}
