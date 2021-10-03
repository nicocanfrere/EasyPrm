<?php

namespace Application\Api\ProductCatalog\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Application\Api\ProductCatalog\Dto\ProductInputDto;
use EasyPrm\ProductCatalog\Command\Product\CreateCommand;
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
        $command = new CreateCommand();
        $command->setLabel($data->getLabel());
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
