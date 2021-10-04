<?php

namespace EasyPrm\AddressBook\Contract;

use EasyPrm\AddressBook\AddressBook;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Interface AddressBookInterface
 */
interface AddressBookInterface
{

    public function getIdentifier(): ?Identifier;

    public function setIdentifier(?Identifier $identifier): AddressBookInterface;

    public function getAddresses();

    public function setAddresses($addresses): AddressBookInterface;

    public function addAddress(AddressInterface $address): AddressBookInterface;

    public function removeAddress(AddressInterface $address): AddressBookInterface;
}
