<?php

namespace EasyPrm\Core\Contract;

use EasyPrm\Core\Validation\Error;

/**
 * Interface ValidationSpecificationInterface
 */
interface ValidationSpecificationInterface
{
    public function isSatisfiedBy($object): bool;

    public function getError(): Error;
}
