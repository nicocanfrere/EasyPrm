<?php

namespace EasyPrm\Tests\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Command\Product\CreateCommand;
use EasyPrm\ProductCatalog\Contract\ProductInterface;
use EasyPrm\ProductCatalog\Dto\ProductDto;
use EasyPrm\ProductCatalog\Exception\ProductAlreadyExistsException;
use EasyPrm\ProductCatalog\Factory\ProductFactory;
use EasyPrm\ProductCatalog\Product;
use EasyPrm\Tests\ProductCatalog\Repository\InMemoryProductRepository;
use EasyPrm\Tests\Transliterator;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateCommandTest
 */
class CreateCommandTest extends TestCase
{
    /** @var TransliteratorInterface */
    private $transliterator;
    private $identifierFactory;

    protected function setUp(): void
    {
        $this->transliterator = new Transliterator();
        $this->identifierFactory = $this->createMock(IdentifierFactoryInterface::class);
    }

    /**
     * @test
     */
    public function handle()
    {
        $this->identifierFactory->method('create')->willReturn(Identifier::create('abcd-efgh'));
        $repository = new InMemoryProductRepository($this->transliterator);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcher->expects($this->once())->method('dispatch');
        $factory = new ProductFactory(
            $this->identifierFactory,
            $this->transliterator
        );
        $command = new CreateCommand(
            $factory,
            $repository,
            $eventDispatcher
        );
        $dto = new ProductDto();
        $dto->label = 'label';
        $command->handle($dto);
        $this->assertInstanceOf(ProductInterface::class, $repository->oneByLabel($dto->label));
    }

    /**
     * @test
     */
    public function throwProductAlreadyExistsException()
    {
        $sameLabel = 'label';
        $repository = new InMemoryProductRepository($this->transliterator);
        $product = new Product(
            Identifier::create('a'),
            $sameLabel,
            $sameLabel
        );
        $repository->save($product);
        $identifierFactory = $this->createMock(IdentifierFactoryInterface::class);
        $identifierFactory->method('create')->willReturn(Identifier::create('b'));
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $factory = new ProductFactory(
            $this->identifierFactory,
            $this->transliterator
        );
        $command = new CreateCommand(
            $factory,
            $repository,
            $eventDispatcher
        );
        $dto = new ProductDto();
        $dto->label = $sameLabel;
        $this->expectException(ProductAlreadyExistsException::class);
        $command->handle($dto);
    }
}
