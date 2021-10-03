<?php

namespace Application\Api\ProductCatalog\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Application\Api\ProductCatalog\Dto\ProductInputDto;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Command\Product\CreateCommand;
use EasyPrm\ProductCatalog\Command\Product\UpdateCommand;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class ProductDataPersister
 */
class ProductDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    /**
     * ProductDataPersister constructor.
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
            $data instanceof ProductInputDto &&
            !empty($context['collection_operation_name']) &&
            $context['collection_operation_name'] === 'create'
        ) {
            return true;
        }
        if (
            $data instanceof ProductInputDto &&
            !empty($context['item_operation_name']) &&
            $context['item_operation_name'] === 'update'
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param ProductInputDto $data
     * @param array $context
     *
     * @return object
     */
    public function persist($data, array $context = [])
    {
        if (!empty($context['collection_operation_name']) &&
            $context['collection_operation_name'] === 'create'
        ) {
            return $this->create($data);
        }
        if (!empty($context['item_operation_name']) &&
            $context['item_operation_name'] === 'update'
        ) {
            return $this->update($data);
        }

        return null;
    }

    private function create(ProductInputDto $data)
    {
        $command = new CreateCommand();
        $command->setLabel($data->getLabel());
        $envelope = $this->commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        if (!$handledStamp instanceof HandledStamp) {
            return $data;
        }

        return $handledStamp->getResult();
    }

    private function update(ProductInputDto $data)
    {
        $command = new UpdateCommand();
        $command->setLabel($data->getLabel());
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
