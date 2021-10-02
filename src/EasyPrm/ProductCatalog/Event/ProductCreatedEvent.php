<?php

namespace EasyPrm\ProductCatalog\Event;

use EasyPrm\Core\Event\Event;
use EasyPrm\ProductCatalog\Contract\ProductInterface;

/**
 * Class ProductCreatedEvent
 */
class ProductCreatedEvent extends Event
{
    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * ProductCreatedEvent constructor.
     *
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }
}
