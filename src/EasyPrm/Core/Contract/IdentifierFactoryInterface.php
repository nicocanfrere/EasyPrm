<?php

namespace EasyPrm\Core\Contract;

use EasyPrm\Core\Factory\IdentifierFactory;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Interface IdentifierFactoryInterface
 */
interface IdentifierFactoryInterface
{

    public function create(): Identifier;
}
