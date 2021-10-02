<?php

namespace EasyPrm\Tests\ProductCatalog\Command\Product;

use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Command\Product\AttachPriceCommand;
use EasyPrm\ProductCatalog\Command\Product\DetachPriceCommand;
use EasyPrm\ProductCatalog\Dto\PriceAttachmentDto;
use EasyPrm\ProductCatalog\Exception\PriceNotFoundException;
use EasyPrm\ProductCatalog\Exception\ProductNotFoundException;
use EasyPrm\ProductCatalog\Price;
use EasyPrm\ProductCatalog\Product;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use EasyPrm\ProductCatalog\ValueObject\Currency;
use EasyPrm\Tests\ProductCatalog\Repository\InMemoryPriceRepository;
use EasyPrm\Tests\ProductCatalog\Repository\InMemoryProductRepository;
use EasyPrm\Tests\Transliterator;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class DetachPriceCommandTest
 */
class DetachPriceCommandTest extends TestCase
{
    private $transliterator;
    private $eventDispatcher;
    private $priceRepository;
    private $productRepository;

    protected function setUp(): void
    {
        $this->transliterator  = new Transliterator();
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->priceRepository   = new InMemoryPriceRepository($this->transliterator);
        $this->productRepository = new InMemoryProductRepository($this->transliterator);
    }

    /**
     * @test
     */
    public function throwProductNotFoundException()
    {
        $priceId           = 'price';
        $price             = new Price(
            Identifier::create($priceId),
            'price',
            'price',
            Amount::create(100),
            Currency::create('EUR')
        );
        $this->priceRepository->save($price);
        $command = new DetachPriceCommand(
            $this->productRepository,
            $this->priceRepository,
            $this->eventDispatcher
        );
        $this->expectException(ProductNotFoundException::class);
        $command->handle(new PriceAttachmentDto('not_found', $priceId));
    }
    /**
     * @test
     */
    public function throwPriceNotFoundException()
    {
        $productId         = 'product';
        $product           = new Product(
            Identifier::create($productId),
            'product',
            'product'
        );
        $this->productRepository->save($product);
        $command = new DetachPriceCommand(
            $this->productRepository,
            $this->priceRepository,
            $this->eventDispatcher
        );
        $this->expectException(PriceNotFoundException::class);
        $command->handle(new PriceAttachmentDto($productId, 'not_found'));
    }

    /**
     * @test
     */
    public function handle()
    {
        $this->eventDispatcher->expects($this->once())->method('dispatch');
        $priceId           = 'price';
        $price             = new Price(
            Identifier::create($priceId),
            'price',
            'price',
            Amount::create(100),
            Currency::create('EUR')
        );
        $this->priceRepository->save($price);
        $productId         = 'product';
        $product           = new Product(
            Identifier::create($productId),
            'product',
            'product'
        );
        $product->addPrice($price);
        $this->assertCount(1, $product->getPrices()->toArray());
        $this->productRepository->save($product);
        $command = new DetachPriceCommand(
            $this->productRepository,
            $this->priceRepository,
            $this->eventDispatcher
        );
        $command->handle(new PriceAttachmentDto($productId, $priceId));
        $this->assertCount(0, $product->getPrices()->toArray());
    }
}
