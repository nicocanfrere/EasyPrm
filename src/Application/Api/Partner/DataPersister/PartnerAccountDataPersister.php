<?php

namespace Application\Api\Partner\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Application\Api\Partner\Dto\PartnerAccountInputDto;
use EasyPrm\Partner\Command\PartnerAccount\CreateCommand;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class PartnerAccountDataPersister
 */
class PartnerAccountDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    /**
     * PartnerAccountDataPersister constructor.
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
            $data instanceof PartnerAccountInputDto &&
            ! empty($context['collection_operation_name']) &&
            $context['collection_operation_name'] === 'create'
        ) {
            return true;
        }

        return false;
    }

    public function persist($data, array $context = [])
    {
        if (
            ! empty($context['collection_operation_name']) &&
             $context['collection_operation_name'] === 'create'
        ) {
            return $this->create($data);
        }

        return null;
    }

    public function remove($data, array $context = [])
    {
        dd($data, $context);
    }

    public function create(PartnerAccountInputDto $data)
    {
        $command = new CreateCommand();
        $command->setLabel($data->getLabel());
        $command->setCompanyNumber($data->getCompanyNumber());
        $envelope     = $this->commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        if (! $handledStamp instanceof HandledStamp) {
            return $data;
        }

        return $handledStamp->getResult();
    }
}
