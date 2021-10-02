<?php

namespace EasyPrm\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\CommandHandlerInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Event\PriceDetachedFromProduct;
use EasyPrm\ProductCatalog\Exception\PriceNotFoundException;
use EasyPrm\ProductCatalog\Exception\ProductNotFoundException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class DetachPriceCommandHandler
 */
class DetachPriceCommandHandler implements CommandHandlerInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;
    /** @var PriceRepositoryInterface */
    private $priceRepository;
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * DetachPriceCommand constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param PriceRepositoryInterface $priceRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        PriceRepositoryInterface $priceRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->productRepository = $productRepository;
        $this->priceRepository   = $priceRepository;
        $this->eventDispatcher   = $eventDispatcher;
    }

    public function handle(DetachPriceCommand $priceAttachmentDto): ?ProductInterface
    {
        if (!$priceAttachmentDto->productIdentifier || !$priceAttachmentDto->priceIdentifier) {
            return null;
        }
        $price = $this->priceRepository->oneByIdentifier($priceAttachmentDto->priceIdentifier);
        if (!$price) {
            throw new PriceNotFoundException();
        }
        $product = $this->productRepository->oneByIdentifier($priceAttachmentDto->productIdentifier);
        if (!$product) {
            throw new ProductNotFoundException();
        }
        $product->removePrice($price);
        $this->productRepository->save($product);
        $this->eventDispatcher->dispatch(
            new PriceDetachedFromProduct($product, $price)
        );

        return $product;
    }
}
