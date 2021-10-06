<?php

namespace EasyPrm\ProductCatalog\Validation\Specification;

use EasyPrm\Core\Contract\ValidationSpecificationInterface;
use EasyPrm\Core\Validation\Error;
use EasyPrm\ProductCatalog\Command\Product\UpdateCommand;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;

/**
 * Class UpdateProductUniquenessValidationSpecification
 */
class UpdateProductUniquenessValidationSpecification implements ValidationSpecificationInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * UpdateProductUniquenessValidationSpecification constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param UpdateCommand $object
     *
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        if (!$object->getProduct()) {
            throw new \RuntimeException();
        }
        if ($object->getLabel() !== $object->getProduct()->getLabel()) {
            $exists = $this->productRepository->oneByLabel($object->getLabel());
            if ($exists && !$exists->getIdentifier()->equals($object->getProduct()->getIdentifier())) {
                return false;
            }
        }

        return true;
    }

    public function getError(): Error
    {
        return new Error(
            'product.already_exists.error'
        );
    }
}
