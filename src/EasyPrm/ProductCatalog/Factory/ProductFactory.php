<?php

namespace EasyPrm\ProductCatalog\Factory;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\ProductCatalog\Contract\ProductFactoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductInterface;
use EasyPrm\ProductCatalog\Product;

/**
 * Class ProductFactory
 */
class ProductFactory implements ProductFactoryInterface
{
    /** @var IdentifierFactoryInterface */
    private $identifierFactory;
    /** @var TransliteratorInterface */
    private $transliterator;

    /**
     * ProductFactory constructor.
     *
     * @param IdentifierFactoryInterface $identifierFactory
     * @param TransliteratorInterface $transliterator
     */
    public function __construct(
        IdentifierFactoryInterface $identifierFactory,
        TransliteratorInterface $transliterator
    ) {
        $this->identifierFactory = $identifierFactory;
        $this->transliterator    = $transliterator;
    }

    public function create(string $label): ProductInterface
    {
        return new Product(
            $this->identifierFactory->create(),
            $label,
            $this->transliterator->transliterate($label)
        );
    }
}
