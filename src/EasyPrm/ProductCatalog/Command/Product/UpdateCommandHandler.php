<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Event\ProductUpdatedEvent;
use EasyPrm\ProductCatalog\Exception\ProductNotFoundException;
use EasyPrm\ProductCatalog\Factory\UpdateProductValidatorFactory;
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
     * @var UpdateProductValidatorFactory
     */
    private $validatorFactory;

    /**
     * UpdateCommand constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param UpdateProductValidatorFactory $validatorFactory
     * @param TransliteratorInterface $transliterator
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        UpdateProductValidatorFactory $validatorFactory,
        TransliteratorInterface $transliterator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->productRepository = $productRepository;
        $this->transliterator    = $transliterator;
        $this->eventDispatcher   = $eventDispatcher;
        $this->validatorFactory  = $validatorFactory;
    }

    public function handle(UpdateCommand $dto)
    {
        if ( ! $dto->identifier) {
            throw new \InvalidArgumentException();
        }
        $original = $this->productRepository->oneByIdentifier($dto->identifier);
        if ( ! $original) {
            throw new ProductNotFoundException();
        }
        $dto->setProduct($original);
        $this->validatorFactory->create()->validate($dto);
        $old = clone $original;
        if ($dto->getLabel() && $dto->getLabel() !== $original->getLabel()) {
            $original
                ->setLabel($dto->getLabel())
                ->setAlias($this->transliterator->transliterate($dto->getLabel()));
        }
        $original->setUpdatedAt(new \DateTime());
        $this->productRepository->save($original);
        $this->eventDispatcher->dispatch(
            new ProductUpdatedEvent($original, $old)
        );

        return $original;
    }
}
