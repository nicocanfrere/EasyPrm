<?php

namespace EasyPrm\Partner\Command\PartnerAccount;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\Partner\Contract\PartnerAccountBuilderInterface;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use EasyPrm\Partner\Event\PartnerAccountCreatedEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateCommandHandler
 */
class CreateCommandHandler implements CommandHandlerInterface
{
    /** @var PartnerAccountBuilderInterface */
    private $partnerAccountBuilder;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * CreateCommandHandler constructor.
     *
     * @param PartnerAccountBuilderInterface $partnerAccountBuilder
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        PartnerAccountBuilderInterface $partnerAccountBuilder,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->partnerAccountBuilder = $partnerAccountBuilder;
        $this->eventDispatcher       = $eventDispatcher;
    }

    public function handle(CreateCommand $command): PartnerAccountInterface
    {
        //TODO validation
        $partnerAccount = $this->partnerAccountBuilder->build(
            $command->getLabel(),
            $command->getCompanyNumber()
        );
        $this->eventDispatcher->dispatch(
            new PartnerAccountCreatedEvent($partnerAccount)
        );

        return $partnerAccount;
    }
}
