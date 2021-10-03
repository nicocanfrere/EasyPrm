<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Event\ProductUpdatedEvent;
use EasyPrm\ProductCatalog\Exception\ProductAlreadyExistsException;
use EasyPrm\ProductCatalog\Exception\ProductNotFoundException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class UpdateCommandHandler
 */
class UpdateCommandHandler implements CommandHandlerInterface
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

    public function handle(UpdateCommand $dto)
    {
        if (!$dto->identifier) {
            throw new \InvalidArgumentException();
        }
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
        $original->setUpdatedAt(new \DateTime());
        $this->productRepository->save($original);
        $this->eventDispatcher->dispatch(
            new ProductUpdatedEvent($original, $old)
        );

        return $original;
    }
}
