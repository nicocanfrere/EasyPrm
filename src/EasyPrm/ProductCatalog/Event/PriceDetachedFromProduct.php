<?php

namespace EasyPrm\ProductCatalog\Event;

use EasyPrm\Core\Event\Event;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\Contract\ProductInterface;

/**
 * Class PriceDetachedFromProduct
 */
class PriceDetachedFromProduct extends Event
{
    /** @var ProductInterface */
    private $product;
    /** @var PriceInterface */
    private $price;

    /**
     * PriceDetachedFromProduct constructor.
     *
     * @param ProductInterface $product
     * @param PriceInterface $price
     */
    public function __construct(ProductInterface $product, PriceInterface $price)
    {
        $this->product = $product;
        $this->price   = $price;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function getPrice(): PriceInterface
    {
        return $this->price;
    }
}
