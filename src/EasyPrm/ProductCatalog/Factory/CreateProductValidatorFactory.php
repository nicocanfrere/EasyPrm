<?php

namespace EasyPrm\ProductCatalog\Factory;

use EasyPrm\Core\Contract\ValidatorInterface;
use EasyPrm\Core\Validation\Validator;
use EasyPrm\ProductCatalog\Contract\CreateProductValidatorFactoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Validation\Specification\CreateProductUniquenessValidationSpecification;
use EasyPrm\ProductCatalog\Validation\Specification\ProductLabelValidationSpecification;

/**
 * Class CreateProductValidatorFactory
 */
class CreateProductValidatorFactory implements CreateProductValidatorFactoryInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * ProductValidatorFactory constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(): ValidatorInterface
    {
        $validator = new Validator();
        $validator
            ->addRule(new ProductLabelValidationSpecification())
            ->addRule(new CreateProductUniquenessValidationSpecification($this->productRepository));

        return $validator;
    }
}
