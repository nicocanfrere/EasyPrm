<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Event\ProductRemovedEvent;
use EasyPrm\ProductCatalog\Exception\ProductNotFoundException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class RemoveCommandHandler
 */
class RemoveCommandHandler implements CommandHandlerInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * RemoveCommand constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->productRepository = $productRepository;
        $this->eventDispatcher   = $eventDispatcher;
    }

    public function handle(RemoveCommand $dto): void
    {
        if (!$dto->identifier) {
            throw new \InvalidArgumentException();
        }
        $product = $this->productRepository->oneByIdentifier($dto->identifier);
        if (!$product) {
            throw new ProductNotFoundException();
        }
        $this->productRepository->remove($product);
        $this->eventDispatcher->dispatch(
            new ProductRemovedEvent($product)
        );
    }
}
