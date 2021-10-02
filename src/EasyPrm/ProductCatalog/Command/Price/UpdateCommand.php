<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class UpdateCommand
 */
class UpdateCommand
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
