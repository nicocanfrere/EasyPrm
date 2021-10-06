<?php

namespace Application\Api\ProductCatalog\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Application\Api\ProductCatalog\Dto\PriceInputDto;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Command\Price\CreateCommand;
use EasyPrm\ProductCatalog\Command\Price\UpdateCommand;
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
        if (
            $data instanceof PriceInputDto &&
            !empty($context['collection_operation_name']) &&
            $context['collection_operation_name'] === 'create'
        ) {
            return true;
        }
        if (
            $data instanceof PriceInputDto &&
            !empty($context['item_operation_name']) &&
            $context['item_operation_name'] === 'update'
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param PriceInputDto $data
     * @param array $context
     *
     * @return object|null
     */
    public function persist($data, array $context = [])
    {
        if (
            !empty($context['collection_operation_name']) &&
            $context['collection_operation_name'] === 'create'
        ) {
            return $this->create($data);
        }
        if (
            !empty($context['item_operation_name']) &&
            $context['item_operation_name'] === 'update'
        ) {
            return $this->update($data);
        }

        return null;
    }

    private function create(PriceInputDto $data)
    {
        $command = new CreateCommand();
        $command->setLabel($data->getLabel());
        $command->setAmount($data->getAmount());
        $command->setCurrency($data->getCurrency());
        $envelope = $this->commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        if (!$handledStamp instanceof HandledStamp) {
            return $data;
        }

        return $handledStamp->getResult();
    }

    public function update(PriceInputDto $data)
    {
        $command = new UpdateCommand();
        $command->setLabel($data->getLabel());
        $command->setAmount($data->getAmount());
        $command->setCurrency($data->getCurrency());
        $command->setIdentifier(Identifier::create($data->getIdentifier()));
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
