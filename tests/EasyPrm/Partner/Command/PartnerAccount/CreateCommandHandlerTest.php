<?php

namespace EasyPrm\Partner\Command\PartnerAccount;

use EasyPrm\Partner\Contract\PartnerAccountBuilderInterface;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateCommandHandlerTest
 */
class CreateCommandHandlerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function handle()
    {
        $partnerAccount = $this->createMock(PartnerAccountInterface::class);
        $builder = $this->createMock(PartnerAccountBuilderInterface::class);
        $builder->method('build')->willReturn($partnerAccount);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcher->expects($this->once())->method('dispatch');
        $handler = new CreateCommandHandler(
            $builder,
            $eventDispatcher
        );
        $command = (new CreateCommand())->setLabel('label')->setCompanyNumber('company_number');
        $result = $handler->handle($command);
        $this->assertEquals($partnerAccount, $result);
    }
}
