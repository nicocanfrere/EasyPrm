<?php

namespace EasyPrm\ProductCatalog\Factory;

use EasyPrm\Core\Contract\ValidatorInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Contract\PriceValidatorFactoryInterface;
use EasyPrm\ProductCatalog\Validation\Specification\CreatePriceUniquenessValidationSpecification;
use EasyPrm\ProductCatalog\Validation\CreatePriceValidator;
use EasyPrm\ProductCatalog\Validation\Specification\PriceAmountValidationSpecification;
use EasyPrm\ProductCatalog\Validation\Specification\PriceCurrencyValidationSpecification;
use EasyPrm\ProductCatalog\Validation\Specification\PriceLabelValidationSpecification;

/**
 * Class PriceValidatorFactory
 */
class PriceValidatorFactory implements PriceValidatorFactoryInterface
{
    /** @var PriceRepositoryInterface */
    private $priceRepository;

    /**
     * PriceValidatorFactory constructor.
     *
     * @param PriceRepositoryInterface $priceRepository
     */
    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    public function create(): ValidatorInterface
    {
        $validator = new CreatePriceValidator();
        $validator
            ->addRule(new PriceLabelValidationSpecification())
            ->addRule(new CreatePriceUniquenessValidationSpecification($this->priceRepository))
            ->addRule(new PriceAmountValidationSpecification())
            ->addRule(new PriceCurrencyValidationSpecification());

        return $validator;
    }
}
