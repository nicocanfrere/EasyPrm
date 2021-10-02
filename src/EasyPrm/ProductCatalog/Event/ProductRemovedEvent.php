<?php

namespace EasyPrm\ProductCatalog\Event;

use EasyPrm\Core\Event\Event;
use EasyPrm\ProductCatalog\Contract\ProductInterface;

/**
 * Class ProductRemovedEvent
 */
class ProductRemovedEvent extends Event
{
    /** @var ProductInterface */
    private $removed;

    /**
     * ProductRemovedEvent constructor.
     *
     * @param ProductInterface $removed
     */
    public function __construct(ProductInterface $removed)
    {
        $this->removed = $removed;
    }

    public function getRemoved(): ProductInterface
    {
        return $this->removed;
    }
}
