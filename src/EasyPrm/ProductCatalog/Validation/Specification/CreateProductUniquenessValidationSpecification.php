<?php

namespace EasyPrm\ProductCatalog\Validation\Specification;

use EasyPrm\Core\Contract\ValidationSpecificationInterface;
use EasyPrm\Core\Validation\Error;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;

/**
 * Class CreateProductUniquenessValidationSpecification
 */
class CreateProductUniquenessValidationSpecification implements ValidationSpecificationInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * CreateProductUniquenessValidationSpecification constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function isSatisfiedBy($object): bool
    {
        return null === $this->productRepository->oneByLabel($object->getLabel());
    }

    public function getError(): Error
    {
        return new Error(
            'product.already_exists.error'
        );
    }
}
