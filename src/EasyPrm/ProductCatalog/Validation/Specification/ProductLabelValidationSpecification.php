<?php

namespace EasyPrm\ProductCatalog\Validation\Specification;

use EasyPrm\Core\Contract\ValidationSpecificationInterface;
use EasyPrm\Core\Validation\Error;

/**
 * Class ProductLabelValidationSpecification
 */
class ProductLabelValidationSpecification implements ValidationSpecificationInterface
{
    public function isSatisfiedBy($object): bool
    {
        return !empty($object->getLabel());
    }

    public function getError(): Error
    {
        return new Error(
            'product.empty_label.error',
            'label'
        );
    }
}
