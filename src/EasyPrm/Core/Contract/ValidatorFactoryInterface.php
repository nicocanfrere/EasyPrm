<?php

namespace EasyPrm\Core\Contract;

/**
 * Interface PriceValidatorFactoryInterface
 */
interface ValidatorFactoryInterface
{

    public function create(): ValidatorInterface;
}
