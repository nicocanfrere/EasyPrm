<?php

namespace EasyPrm\Tests\ProductCatalog\Command;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Factory\IdentifierFactory;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Command\Price\CreateCommand;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
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
        $transliterator = new Transliterator();
        $identifierFactory = $this->createMock(IdentifierFactoryInterface::class);
        $identifierFactory->method('create')->willReturn(Identifier::create('abcd-efgh'));
        $repository = new InMemoryPriceRepository($transliterator);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcher->expects($this->once())->method('dispatch');
        $factory = new PriceFactory(
            $identifierFactory,
            $transliterator
        );
        $command = new CreateCommand(
            $factory,
            $repository,
            $eventDispatcher
        );
        $command->handle(['label' => 'label', 'amount' => 100, 'currency' => 'EUR']);
        $this->assertInstanceOf(PriceInterface::class, $repository->oneByLabel('label'));
    }
}
