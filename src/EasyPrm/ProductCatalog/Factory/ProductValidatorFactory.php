<?php

namespace EasyPrm\ProductCatalog\Factory;

use EasyPrm\Core\Contract\ValidatorInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductValidatorFactoryInterface;
use EasyPrm\ProductCatalog\Validation\Specification\CreateProductUniquenessValidationSpecification;
use EasyPrm\ProductCatalog\Validation\CreateProductValidator;
use EasyPrm\ProductCatalog\Validation\Specification\ProductLabelValidationSpecification;

/**
 * Class ProductValidatorFactory
 */
class ProductValidatorFactory implements ProductValidatorFactoryInterface
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
        $validator = new CreateProductValidator();
        $validator
            ->addRule(new ProductLabelValidationSpecification())
            ->addRule(new CreateProductUniquenessValidationSpecification($this->productRepository))
            ;

        return $validator;
    }
}
