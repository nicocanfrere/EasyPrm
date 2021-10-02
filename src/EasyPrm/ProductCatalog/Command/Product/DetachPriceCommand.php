<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class DetachPriceCommand
 */
class DetachPriceCommand
{
    /**
     * @var Identifier|null
     */
    public $priceIdentifier;
    /**
     * @var Identifier|null
     */
    public $productIdentifier;

    /**
     * PriceAttachmentDto constructor.
     *
     * @param string|null $productIdentifier
     * @param string|null $priceIdentifier
     */
    public function __construct(?string $productIdentifier, ?string $priceIdentifier)
    {
        $this->productIdentifier = $productIdentifier ? Identifier::create($productIdentifier) : null;
        $this->priceIdentifier   = $priceIdentifier ? Identifier::create($priceIdentifier) : null;
    }
}
