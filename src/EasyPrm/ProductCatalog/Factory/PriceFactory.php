<?php

namespace EasyPrm\ProductCatalog\Factory;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
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
     * @var TransliteratorInterface
     */
    private $transliterator;

    /**
     * PriceFactory constructor.
     *
     * @param IdentifierFactoryInterface $identifierFactory
     * @param TransliteratorInterface $transliterator
     */
    public function __construct(
        IdentifierFactoryInterface $identifierFactory,
        TransliteratorInterface $transliterator
    ) {
        $this->identifierFactory = $identifierFactory;
        $this->transliterator = $transliterator;
    }

    public function create(string $label, $amount, string $currency): PriceInterface
    {
        return new Price(
            $this->identifierFactory->create(),
            $label,
            $this->transliterator->transliterate($label),
            Amount::create($amount),
            Currency::create($currency)
        );
    }
}
