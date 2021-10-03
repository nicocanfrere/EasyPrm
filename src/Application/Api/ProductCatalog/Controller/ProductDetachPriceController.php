<?php

namespace Application\Api\ProductCatalog\Controller;

use EasyPrm\ProductCatalog\Command\Product\DetachPriceCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class ProductDetachPriceController
 */
class ProductDetachPriceController
{
    /** @var MessageBusInterface */
    private $commandBus;

    /**
     * ProductDetachPriceController constructor.
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
        $envelope = $this->commandBus->dispatch(
            new DetachPriceCommand($data['product_identifier'], $data['price_identifier'])
        );
        $handledStamp = $envelope->last(HandledStamp::class);
        if (!$handledStamp instanceof HandledStamp) {
            return $data;
        }

        return $handledStamp->getResult();
    }
}
