<?php

namespace EasyPrm\Tests\ProductCatalog\Command\Price;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\ValidatorInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Command\Price\CreateCommand;
use EasyPrm\ProductCatalog\Command\Price\CreateCommandHandler;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\Contract\PriceValidatorFactoryInterface;
use EasyPrm\ProductCatalog\Factory\PriceFactory;
use EasyPrm\Tests\ProductCatalog\Repository\InMemoryPriceRepository;
use EasyPrm\Tests\Transliterator;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateCommand
 */
class CreateCommandTest extends TestCase
{
    /**
     * @test
     */
    public function handle()
    {
        $validator        = $this->createMock(ValidatorInterface::class);
        $validatorFactory = $this->createMock(PriceValidatorFactoryInterface::class);
        $validatorFactory->method('create')->willReturn($validator);
        $transliterator    = new Transliterator();
        $identifierFactory = $this->createMock(IdentifierFactoryInterface::class);
        $identifierFactory->method('create')->willReturn(Identifier::create('identifier'));
        $repository      = new InMemoryPriceRepository($transliterator);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcher->expects($this->once())->method('dispatch');
        $factory = new PriceFactory(
            $identifierFactory,
            $transliterator
        );
        $command = new CreateCommandHandler(
            $factory,
            $validatorFactory,
            $repository,
            $eventDispatcher
        );
        $dto     = new CreateCommand();
        $dto->setLabel('label');
        $dto->setAmount(100);
        $dto->setCurrency('EUR');
        $price = $command->handle($dto);
        $this->assertInstanceOf(PriceInterface::class, $price);
        $this->assertEquals('identifier', $price->getIdentifier()->getValue());
        $this->assertEquals('label', $price->getLabel());
        $this->assertEquals(100, $price->getAmount()->getValue());
        $this->assertEquals('EUR', $price->getCurrency()->getValue());
        $this->assertInstanceOf(PriceInterface::class, $repository->oneByLabel($dto->getLabel()));
    }
}
