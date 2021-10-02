<?php

namespace Application\Api\ProductCatalog\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Application\Api\ProductCatalog\Dto\PriceInputDto;
use EasyPrm\ProductCatalog\Command\Price\CreateCommand;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class PriceDataPersister
 */
class PriceDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    /**
     * PriceDataPersister constructor.
     *
     * @param MessageBusInterface $commandBus
     */
    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof PriceInputDto;
    }

    /**
     * @param PriceInputDto $data
     * @param array $context
     *
     * @return object
     */
    public function persist($data, array $context = [])
    {
        $command = new CreateCommand();
        $command->label = $data->getLabel();
        $command->amount = $data->getAmount();
        $command->currency = $data->getCurrency();
        $envelope = $this->commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        if (!$handledStamp instanceof HandledStamp) {
            return $data;
        }

        return $handledStamp->getResult();
    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}
