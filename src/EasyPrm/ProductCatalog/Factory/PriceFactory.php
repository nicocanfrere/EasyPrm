<?php

namespace EasyPrm\ProductCatalog\Factory;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\ProductCatalog\Contract\PriceFactoryInterface;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\Price;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use EasyPrm\ProductCatalog\ValueObject\Currency;

/**
 * Class PriceFactory
 */
class PriceFactory implements PriceFactoryInterface
{
    /** @var IdentifierFactoryInterface */
    private $identifierFactory;

    /**
     * PriceFactory constructor.
     *
     * @param IdentifierFactoryInterface $identifierFactory
     */
    public function __construct(IdentifierFactoryInterface $identifierFactory)
    {
        $this->identifierFactory = $identifierFactory;
    }

    public function create(string $label, $amount, string $currency): PriceInterface
    {
        return new Price(
            $this->identifierFactory->create(),
            $label,
            Amount::create($amount),
            Currency::create($currency)
        );
    }
}
