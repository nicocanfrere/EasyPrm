<?php

namespace EasyPrm\Tests\Partner\Factory;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use EasyPrm\Partner\Contract\PartnerAccountNumberFactoryInterface;
use EasyPrm\Partner\Factory\PartnerAccountFactory;
use EasyPrm\Partner\ValueObject\PartnerAccountNumber;
use EasyPrm\Tests\Transliterator;
use PHPUnit\Framework\TestCase;

/**
 * Class PartnerAccountFactoryTest
 */
class PartnerAccountFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function create()
    {
        $identifierFactory = $this->createMock(IdentifierFactoryInterface::class);
        $identifierFactory->method('create')->willReturn(Identifier::create('identifier'));
        $partnerAccountNumberFactory = $this->createMock(PartnerAccountNumberFactoryInterface::class);
        $partnerAccountNumberFactory->method('create')->willReturn(PartnerAccountNumber::create('account_number'));
        $transliterator = $this->createMock(TransliteratorInterface::class);
        $transliterator->method('transliterate')->willReturn('alias');
        $factory = new PartnerAccountFactory(
            $identifierFactory,
            $partnerAccountNumberFactory,
            $transliterator
        );
        $label = 'New Account';
        $companyNumber = '99999999999999';
        $result = $factory->create($label, $companyNumber);
        $this->assertInstanceOf(PartnerAccountInterface::class, $result);
        $this->assertEquals($label, $result->getLabel());
        $this->assertEquals($companyNumber, $result->getCompanyNumber());
        $this->assertTrue($result->getIdentifier()->equals(Identifier::create('identifier')));
        $this->assertTrue($result->getAccountNumber()->equals(PartnerAccountNumber::create('account_number')));
        $this->assertEquals('alias', $result->getAlias());
        $this->assertNull($result->getAddressBook());
        $this->assertNull($result->getPhoneBook());
    }
}
