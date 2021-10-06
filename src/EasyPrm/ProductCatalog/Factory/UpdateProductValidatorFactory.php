<?php

namespace EasyPrm\ProductCatalog\Factory;

use EasyPrm\Core\Contract\ValidatorInterface;
use EasyPrm\Core\Validation\Validator;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Contract\UpdateProductValidatorFactoryInterface;
use EasyPrm\ProductCatalog\Validation\Specification\UpdateProductUniquenessValidationSpecification;

/**
 * Class UpdateProductValidatorFactory
 */
class UpdateProductValidatorFactory implements UpdateProductValidatorFactoryInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * UpdateProductValidatorFactory constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(): ValidatorInterface
    {
        $validator = $validator = new Validator();
        $validator
            ->addRule(new UpdateProductUniquenessValidationSpecification($this->productRepository));

        return $validator;
    }
}
