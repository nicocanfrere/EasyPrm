<?php

namespace EasyPrm\ProductCatalog\Event;

use EasyPrm\Core\Event\Event;
use EasyPrm\ProductCatalog\Contract\PriceInterface;

/**
 * Class PriceCreatedEvent
 */
class PriceCreatedEvent extends Event
{
    /** @var PriceInterface */
    private $price;

    /**
     * PriceCreatedEvent constructor.
     *
     * @param PriceInterface $price
     */
    public function __construct(PriceInterface $price)
    {
        $this->price = $price;
    }

    /**
     * @return PriceInterface
     */
    public function getPrice(): PriceInterface
    {
        return $this->price;
    }
}
