<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Dto\ProductDto;
use EasyPrm\ProductCatalog\Exception\ProductAlreadyExistsException;
use EasyPrm\ProductCatalog\Exception\ProductNotFoundException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class UpdateCommand
 */
class UpdateCommand
{
    /** @var ProductRepositoryInterface */
    private $productRepository;
    /** @var TransliteratorInterface */
    private $transliterator;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * UpdateCommand constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param TransliteratorInterface $transliterator
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        TransliteratorInterface $transliterator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->productRepository = $productRepository;
        $this->transliterator    = $transliterator;
        $this->eventDispatcher   = $eventDispatcher;
    }

    public function handle(ProductDto $dto)
    {
        $original = $this->productRepository->oneByIdentifier($dto->identifier);
        if (!$original) {
            throw new ProductNotFoundException();
        }
        $old = clone $original;
        if ($dto->label && $dto->label !== $original->getLabel()) {
            $exists = $this->productRepository->oneByLabel($dto->label);
            if ($exists && !$exists->getIdentifier()->equals($original->getIdentifier())) {
                throw new ProductAlreadyExistsException();
            }
            $original
                ->setLabel($dto->label)
                ->setAlias($this->transliterator->transliterate($dto->label));
        }
        $this->productRepository->save($original);
        $this->eventDispatcher->dispatch(
            new ProductUpdatedEvent($original, $old)
        );
    }
}
