<?php

namespace EasyPrm\ProductCatalog\Command\Price;

use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Dto\PriceDto;
use EasyPrm\ProductCatalog\Event\PriceUpdatedEvent;
use EasyPrm\ProductCatalog\Exception\PriceAlreadyExistsException;
use EasyPrm\ProductCatalog\Exception\PriceNotFoundException;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use EasyPrm\ProductCatalog\ValueObject\Currency;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class UpdateCommand
 */
class UpdateCommand
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

    public function handle(PriceDto $dto): void
    {
        if (!$dto->identifier) {
            throw new \InvalidArgumentException();
        }
        $original = $this->priceRepository->oneByIdentifier($dto->identifier);
        if (!$original) {
            throw new PriceNotFoundException();
        }
        $old = clone $original;
        if ($dto->label && $dto->label !== $original->getLabel()) {
            $exists = $this->priceRepository->oneByLabel($dto->label);
            if ($exists && !$exists->getIdentifier()->equals($original->getIdentifier())) {
                throw new PriceAlreadyExistsException();
            }
            $original
                ->setLabel($dto->label)
                ->setAlias($this->transliterator->transliterate($dto->label));
        }
        if ($dto->amount !== null) {
            $amount = Amount::create($dto->amount);
            if (!$amount->equals($original->getAmount())) {
                $original->setAmount($amount);
            }
        }
        if ($dto->currency) {
            $currency = Currency::create($dto->currency);
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
