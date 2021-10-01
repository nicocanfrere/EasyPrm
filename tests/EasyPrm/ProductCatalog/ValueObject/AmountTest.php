<?php

namespace EasyPrm\Tests\ProductCatalog\ValueObject;

use EasyPrm\ProductCatalog\Exception\InvalidAmountException;
use EasyPrm\ProductCatalog\ValueObject\Amount;
use PHPUnit\Framework\TestCase;

/**
 * Class AmountTest
 */
class AmountTest extends TestCase
{
    /**
     * @test
     */
    public function isValid()
    {
        $this->assertTrue(Amount::isValid(1));
        $this->assertTrue(Amount::isValid(-1));
        $this->assertTrue(Amount::isValid(1.0));
        $this->assertTrue(Amount::isValid(-1.0));
        $this->assertTrue(Amount::isValid('1'));
        $this->assertTrue(Amount::isValid('-1'));
        $this->assertTrue(Amount::isValid('1.0'));
        $this->assertTrue(Amount::isValid('-1.0'));
        $this->assertFalse(Amount::isValid(''));
        $this->assertFalse(Amount::isValid('a'));
        $this->assertFalse(Amount::isValid((PHP_INT_MAX / Amount::PRECISION) + 1));
        $this->assertFalse(Amount::isValid((PHP_INT_MIN / Amount::PRECISION) - 1));
    }

    /**
     * @test
     */
    public function create()
    {
        $amount = Amount::create(1.000010);
        $this->assertTrue(1000010 === $amount->getRawValue());
        $this->assertTrue(1.00001 == $amount->getValue());
        // perte de précision au 6ème chiffre derrière la virgule
        $amount = Amount::create(1.000001);
        $this->assertEquals(1000000, $amount->getRawValue());
        $this->assertEquals(1, $amount->getValue());
    }

    /**
     * @test
     */
    public function throwInvalidAmountExceptionOnNonNumeric()
    {
        $this->expectException(InvalidAmountException::class);
        $amount = Amount::create('abc');
    }

    /**
     * @test
     */
    public function throwInvalidAmountExceptionOnValueToHigh()
    {
        $this->expectException(InvalidAmountException::class);
        $amount = Amount::create(((PHP_INT_MAX / Amount::PRECISION) + 1));
        $this->expectException(InvalidAmountException::class);
        $amount = Amount::create(((PHP_INT_MIN / Amount::PRECISION) - 1));
    }
}
