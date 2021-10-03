<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\Core\Contract\ValidatorInterface;
use EasyPrm\ProductCatalog\Contract\CreatePriceValidatorInterface;
use EasyPrm\ProductCatalog\Contract\PriceFactoryInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Contract\PriceValidatorFactoryInterface;
use EasyPrm\ProductCatalog\Event\PriceCreatedEvent;
use EasyPrm\ProductCatalog\Exception\PriceAlreadyExistsException;
use EasyPrm\ProductCatalog\Validation\CreatePriceValidator;
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
    /** @var PriceValidatorFactoryInterface  */
    private $priceValidatorFactory;

    /**
     * CreateCommand constructor.
     *
     * @param PriceFactoryInterface $priceFactory
     * @param PriceValidatorFactoryInterface $priceValidatorFactory
     * @param PriceRepositoryInterface $priceRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        PriceFactoryInterface $priceFactory,
        PriceValidatorFactoryInterface $priceValidatorFactory,
        PriceRepositoryInterface $priceRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->priceFactory    = $priceFactory;
        $this->priceRepository = $priceRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->priceValidatorFactory = $priceValidatorFactory;
    }

    public function handle(CreateCommand $dto)
    {
        $this->priceValidatorFactory->create()->validate($dto);
        $price = $this->priceFactory->create(
            $dto->getLabel(),
            $dto->getAmount(),
            $dto->getCurrency()
        );
        $this->priceRepository->save($price);
        $this->eventDispatcher->dispatch(
            new PriceCreatedEvent($price)
        );

        return $price;
    }
}
