<?php

namespace Application\Api\ProductCatalog\Controller;

use EasyPrm\ProductCatalog\Command\Product\AttachPriceCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class ProductAttachPriceController
 */
class ProductAttachPriceController
{
    /** @var MessageBusInterface */
    private $commandBus;

    /**
     * ProductAttachPriceController constructor.
     *
     * @param MessageBusInterface $commandBus
     */
    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {
        $data = \json_decode($request->getContent(), true);
        $command = new AttachPriceCommand($data['product_identifier'], $data['price_identifier']);
        $envelope = $this->commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        if (!$handledStamp instanceof HandledStamp) {
            return $data;
        }

        return $handledStamp->getResult();
    }
}
