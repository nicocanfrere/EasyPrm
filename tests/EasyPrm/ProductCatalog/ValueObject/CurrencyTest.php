<?php

namespace EasyPrm\ProductCatalog\ValueObject;

use EasyPrm\ProductCatalog\Exception\InvalidCurrencyException;
use PHPUnit\Framework\TestCase;

/**
 * Class CurrencyTest
 */
class CurrencyTest extends TestCase
{
    /**
     * @test
     */
    public function isValid()
    {
        $this->assertTrue(Currency::isValid('EUR'));
        $this->assertFalse(Currency::isValid('eur'));
        $this->assertFalse(Currency::isValid(' EUR '));
        $this->assertFalse(Currency::isValid('EURO'));
        $this->assertFalse(Currency::isValid('euro'));
        $this->assertFalse(Currency::isValid('euro'));
        $this->assertFalse(Currency::isValid(' <strong>EUR</strong> '));
    }

    /**
     * @test
     */
    public function create()
    {
        $currency = Currency::create('eur');
        $this->assertEquals('EUR', $currency->getValue());
        $currency = Currency::create(' <strong>eur</strong> ');
        $this->assertEquals('EUR', $currency->getValue());
    }

    /**
     * @test
     */
    public function throwInvalidCurrencyException()
    {
        $this->expectException(InvalidCurrencyException::class);
        $currency = Currency::create(' <strong>eu</strong> ');
    }
}
