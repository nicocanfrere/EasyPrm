<?php

namespace EasyPrm\ProductCatalog\Validation\Specification;

use EasyPrm\Core\Contract\ValidationSpecificationInterface;
use EasyPrm\Core\Validation\Error;
use EasyPrm\ProductCatalog\ValueObject\Amount;

/**
 * Class PriceAmountValidationSpecification
 */
class PriceAmountValidationSpecification implements ValidationSpecificationInterface
{
    public function isSatisfiedBy($object): bool
    {
        try {
            Amount::create($object->getAmount());

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getError(): Error
    {
        return new Error(
            'invalid.amount',
            'amount'
        );
    }
}
