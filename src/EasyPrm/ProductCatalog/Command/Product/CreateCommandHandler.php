<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\ProductCatalog\Contract\ProductFactoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Event\ProductCreatedEvent;
use EasyPrm\ProductCatalog\Exception\ProductAlreadyExistsException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateCommandHandler
 */
class CreateCommandHandler implements CommandHandlerInterface
{
    /** @var ProductFactoryInterface */
    private $productFactory;
    /** @var ProductRepositoryInterface */
    private $productRepository;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * CreateCommand constructor.
     *
     * @param ProductFactoryInterface $productFactory
     * @param ProductRepositoryInterface $productRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ProductFactoryInterface $productFactory,
        ProductRepositoryInterface $productRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->productFactory    = $productFactory;
        $this->productRepository = $productRepository;
        $this->eventDispatcher   = $eventDispatcher;
    }

    public function handle(CreateCommand $dto)
    {
        //TODO data validation
        $exists = $this->productRepository->oneByLabel($dto->label);
        if ($exists) {
            throw new ProductAlreadyExistsException();
        }
        $product = $this->productFactory->create($dto->label);
        $this->productRepository->save($product);
        $this->eventDispatcher->dispatch(
            new ProductCreatedEvent($product)
        );

        return $product;
    }
}
