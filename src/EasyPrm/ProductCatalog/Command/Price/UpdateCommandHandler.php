<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Event\PriceUpdatedEvent;
use EasyPrm\ProductCatalog\Exception\PriceAlreadyExistsException;
use EasyPrm\ProductCatalog\Exception\PriceNotFoundException;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use EasyPrm\ProductCatalog\ValueObject\Currency;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class UpdateCommandHandler
 */
class UpdateCommandHandler implements CommandHandlerInterface
{
    /** @var PriceRepositoryInterface */
    private $priceRepository;
    /** @var TransliteratorInterface */
    private $transliterator;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * UpdateCommand constructor.
     *
     * @param PriceRepositoryInterface $priceRepository
     * @param TransliteratorInterface $transliterator
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        PriceRepositoryInterface $priceRepository,
        TransliteratorInterface $transliterator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->priceRepository = $priceRepository;
        $this->transliterator = $transliterator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(UpdateCommand $dto): void
    {
        if (!$dto->getIdentifier()) {
            throw new \InvalidArgumentException();
        }
        $original = $this->priceRepository->oneByIdentifier($dto->getIdentifier());
        if (!$original) {
            throw new PriceNotFoundException();
        }
        $old = clone $original;
        if ($dto->getLabel() && $dto->getLabel() !== $original->getLabel()) {
            $exists = $this->priceRepository->oneByLabel($dto->getLabel());
            if ($exists && !$exists->getIdentifier()->equals($original->getIdentifier())) {
                throw new PriceAlreadyExistsException();
            }
            $original
                ->setLabel($dto->getLabel())
                ->setAlias($this->transliterator->transliterate($dto->getLabel()));
        }
        if ($dto->getAmount() !== null) {
            $amount = Amount::create($dto->getAmount());
            if (!$amount->equals($original->getAmount())) {
                $original->setAmount($amount);
            }
        }
        if ($dto->getCurrency()) {
            $currency = Currency::create($dto->getCurrency());
            if (!$currency->equals($original->getCurrency())) {
                $original->setCurrency($currency);
            }
        }
        $this->priceRepository->save($original);
        $this->eventDispatcher->dispatch(
            new PriceUpdatedEvent($original, $old)
        );
    }
}
