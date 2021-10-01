<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\ProductCatalog\Contract\PriceFactoryInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Event\PriceCreatedEvent;
use EasyPrm\ProductCatalog\Exception\ProductAlreadyExistsException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateCommand
 */
class CreateCommand
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

    public function handle(array $data)
    {
        //TODO data validation
        $exists = $this->priceRepository->oneByLabel($data['label']);
        if ($exists) {
            throw new ProductAlreadyExistsException();
        }
        $price = $this->priceFactory->create(
            $data['label'],
            $data['amount'],
            $data['currency']
        );
        $this->priceRepository->save($price);
        $this->eventDispatcher->dispatch(
            new PriceCreatedEvent($price)
        );
    }
}
