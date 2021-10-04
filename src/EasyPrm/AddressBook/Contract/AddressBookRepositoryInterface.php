<?php

namespace EasyPrm\AddressBook\Contract;

/**
 * Interface AddressBookRepositoryInterface
 */
interface AddressBookRepositoryInterface
{
    public function save(AddressBookInterface $addressBook): void;
    public function remove(AddressBookInterface $addressBook): void;
    public function oneByIdentifier($identifier): ?AddressBookInterface;
}
