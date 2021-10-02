<?php

namespace EasyPrm\ProductCatalog\Event;

use EasyPrm\ProductCatalog\Contract\ProductInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ProductUpdatedEvent
 */
class ProductUpdatedEvent extends Event
{
    /** @var ProductInterface */
    private $updated;
    /** @var ProductInterface */
    private $old;

    /**
     * ProductUpdatedEvent constructor.
     *
     * @param ProductInterface $updated
     * @param ProductInterface $old
     */
    public function __construct(ProductInterface $updated, ProductInterface $old)
    {
        $this->updated = $updated;
        $this->old     = $old;
    }

    public function getUpdated(): ProductInterface
    {
        return $this->updated;
    }

    public function getOld(): ProductInterface
    {
        return $this->old;
    }
}
