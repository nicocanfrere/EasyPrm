<?php

namespace EasyPrm\ProductCatalog\Validation\Specification;

use EasyPrm\Core\Contract\ValidationSpecificationInterface;
use EasyPrm\Core\Validation\Error;
use EasyPrm\ProductCatalog\ValueObject\Currency;

/**
 * Class PriceCurrencyValidationSpecification
 */
class PriceCurrencyValidationSpecification implements ValidationSpecificationInterface
{

    public function isSatisfiedBy($object): bool
    {
        try {
            Currency::create($object->getCurrency());

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getError(): Error
    {
        return new Error(
            'invalid.currency',
            'currency'
        );
    }
}
