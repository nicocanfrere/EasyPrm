<?php

namespace EasyPrm\ProductCatalog\Dto;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class PriceDto
 */
class PriceDto
{
    /** @var string|null */
    public $label;
    /** @var mixed */
    public $amount;
    /** @var string|null */
    public $currency;
    /** @var Identifier|null */
    public $identifier;
}
