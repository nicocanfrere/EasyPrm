<?php

namespace EasyPrm\ProductCatalog\Validation\Specification;

use EasyPrm\Core\Contract\ValidationSpecificationInterface;
use EasyPrm\Core\Validation\Error;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;

/**
 * Class CreatePriceUniquenessValidationSpecification
 */
class CreatePriceUniquenessValidationSpecification implements ValidationSpecificationInterface
{
    /** @var PriceRepositoryInterface */
    private $priceRepository;

    /**
     * PriceUniquenessValidationSpecification constructor.
     *
     * @param PriceRepositoryInterface $priceRepository
     */
    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    public function isSatisfiedBy($object): bool
    {
        return null === $this->priceRepository->oneByLabel($object->getLabel());
    }

    public function getError(): Error
    {
        return new Error(
            'price.already_exists.error'
        );
    }
}
