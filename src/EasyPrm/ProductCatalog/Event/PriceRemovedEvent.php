<?php

namespace EasyPrm\ProductCatalog\Event;

use EasyPrm\Core\Event\Event;
use EasyPrm\ProductCatalog\Contract\PriceInterface;

/**
 * Class PriceRemovedEvent
 */
class PriceRemovedEvent extends Event
{
    /** @var PriceInterface */
    private $removed;

    /**
     * PriceRemovedEvent constructor.
     *
     * @param PriceInterface $removed
     */
    public function __construct(PriceInterface $removed)
    {
        $this->removed = $removed;
    }

    public function getRemoved(): PriceInterface
    {
        return $this->removed;
    }
}
