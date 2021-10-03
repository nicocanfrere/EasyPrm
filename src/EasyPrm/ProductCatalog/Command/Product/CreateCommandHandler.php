<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\ProductCatalog\Contract\ProductFactoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductValidatorFactoryInterface;
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
    /** @var ProductValidatorFactoryInterface */
    private $productValidatorFactory;

    /**
     * CreateCommand constructor.
     *
     * @param ProductFactoryInterface $productFactory
     * @param ProductValidatorFactoryInterface $productValidatorFactory
     * @param ProductRepositoryInterface $productRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ProductFactoryInterface $productFactory,
        ProductValidatorFactoryInterface $productValidatorFactory,
        ProductRepositoryInterface $productRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->productFactory    = $productFactory;
        $this->productRepository = $productRepository;
        $this->eventDispatcher   = $eventDispatcher;
        $this->productValidatorFactory = $productValidatorFactory;
    }

    public function handle(CreateCommand $dto)
    {
        $this->productValidatorFactory->create()->validate($dto);
        $product = $this->productFactory->create($dto->getLabel());
        $this->productRepository->save($product);
        $this->eventDispatcher->dispatch(
            new ProductCreatedEvent($product)
        );

        return $product;
    }
}
