<?php

namespace EasyPrm\PhoneNumberBook\Contract;

use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\PhoneNumberBook\PhoneNumberBook;

/**
 * Interface PhoneNumberBookInterface
 */
interface PhoneNumberBookInterface
{

    public function getNumbers();

    public function setNumbers($numbers): PhoneNumberBookInterface;

    public function removeNumber(PhoneNumberInterface $number): PhoneNumberBookInterface;

    public function setIdentifier(?Identifier $identifier): PhoneNumberBookInterface;

    public function getIdentifier(): ?Identifier;

    public function addNumber(PhoneNumberInterface $number): PhoneNumberBookInterface;
}
