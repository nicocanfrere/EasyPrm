<?php

namespace EasyPrm\ProductCatalog\Dto;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class PriceAttachmentDto
 */
class PriceAttachmentDto
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
