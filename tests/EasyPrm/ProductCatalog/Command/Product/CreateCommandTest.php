<?php

namespace EasyPrm\Tests\ProductCatalog\Command\Product;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\Core\Contract\ValidatorInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Command\Product\CreateCommand;
use EasyPrm\ProductCatalog\Command\Product\CreateCommandHandler;
use EasyPrm\ProductCatalog\Contract\CreateProductValidatorFactoryInterface;
use EasyPrm\ProductCatalog\Contract\ProductInterface;
use EasyPrm\ProductCatalog\Factory\ProductFactory;
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
        $this->transliterator    = new Transliterator();
        $this->identifierFactory = $this->createMock(IdentifierFactoryInterface::class);
    }

    /**
     * @test
     */
    public function handle()
    {
        $validator        = $this->createMock(ValidatorInterface::class);
        $validatorFactory = $this->createMock(CreateProductValidatorFactoryInterface::class);
        $validatorFactory->method('create')->willReturn($validator);
        $this->identifierFactory->method('create')->willReturn(Identifier::create('identifier'));
        $repository      = new InMemoryProductRepository($this->transliterator);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcher->expects($this->once())->method('dispatch');
        $factory = new ProductFactory(
            $this->identifierFactory,
            $this->transliterator
        );
        $command = new CreateCommandHandler(
            $factory,
            $validatorFactory,
            $repository,
            $eventDispatcher
        );
        $dto     = new CreateCommand();
        $dto->setLabel('label');
        $product = $command->handle($dto);
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('identifier', $product->getIdentifier()->getValue());
        $this->assertEquals('label', $product->getLabel());
        $this->assertInstanceOf(ProductInterface::class, $repository->oneByLabel($dto->getLabel()));
    }
}
