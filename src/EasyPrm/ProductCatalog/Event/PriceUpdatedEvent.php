<?php

namespace EasyPrm\ProductCatalog\Event;

use EasyPrm\Core\Event\Event;
use EasyPrm\ProductCatalog\Contract\PriceInterface;

/**
 * Class PriceUpdatedEvent
 */
class PriceUpdatedEvent extends Event
{
    /** @var PriceInterface */
    private $updated;
    /** @var PriceInterface */
    private $old;

    /**
     * PriceUpdatedEvent constructor.
     *
     * @param PriceInterface $updated
     * @param PriceInterface $old
     */
    public function __construct(PriceInterface $updated, PriceInterface $old)
    {
        $this->updated = $updated;
        $this->old = $old;
    }

    public function getUpdated(): PriceInterface
    {
        return $this->updated;
    }

    public function getOld(): PriceInterface
    {
        return $this->old;
    }
}
