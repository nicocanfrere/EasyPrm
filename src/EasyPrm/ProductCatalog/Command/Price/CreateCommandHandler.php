<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\ProductCatalog\Contract\PriceFactoryInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Event\PriceCreatedEvent;
use EasyPrm\ProductCatalog\Exception\PriceAlreadyExistsException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateCommandHandler
 */
class CreateCommandHandler implements CommandHandlerInterface
{
    /** @var PriceFactoryInterface */
    private $priceFactory;
    /** @var PriceRepositoryInterface */
    private $priceRepository;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * CreateCommand constructor.
     *
     * @param PriceFactoryInterface $priceFactory
     * @param PriceRepositoryInterface $priceRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        PriceFactoryInterface $priceFactory,
        PriceRepositoryInterface $priceRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->priceFactory    = $priceFactory;
        $this->priceRepository = $priceRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(CreateCommand $dto): void
    {
        //TODO data validation
        $exists = $this->priceRepository->oneByLabel($dto->label);
        if ($exists) {
            throw new PriceAlreadyExistsException();
        }
        $price = $this->priceFactory->create(
            $dto->label,
            $dto->amount,
            $dto->currency
        );
        $this->priceRepository->save($price);
        $this->eventDispatcher->dispatch(
            new PriceCreatedEvent($price)
        );
    }
}
