<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Event\PriceRemovedEvent;
use EasyPrm\ProductCatalog\Exception\PriceNotFoundException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class RemoveCommandHandler
 */
class RemoveCommandHandler implements CommandHandlerInterface
{
    /** @var PriceRepositoryInterface */
    private $priceRepository;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * RemoveCommand constructor.
     *
     * @param PriceRepositoryInterface $priceRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        PriceRepositoryInterface $priceRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->priceRepository = $priceRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(RemoveCommand $dto): void
    {
        if (!$dto->getIdentifier()) {
            throw new \InvalidArgumentException();
        }
        $price = $this->priceRepository->oneByIdentifier($dto->getIdentifier());
        if (!$price) {
            throw new PriceNotFoundException();
        }
        $this->priceRepository->remove($price);
        $this->eventDispatcher->dispatch(
            new PriceRemovedEvent($price)
        );
    }
}
