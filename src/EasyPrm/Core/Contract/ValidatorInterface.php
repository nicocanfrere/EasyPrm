<?php

namespace EasyPrm\Core\Contract;

/**
 * Interface ValidatorInterface
 */
interface ValidatorInterface
{
    public function validate($object);

    public function addRule(ValidationSpecificationInterface $specification): ValidatorInterface;
}
