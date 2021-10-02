<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class UpdateCommand
 */
class UpdateCommand
{
    /** @var string|null */
    public $label;
    /** @var Identifier|null */
    public $identifier;
}
