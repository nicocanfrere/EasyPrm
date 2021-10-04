<?php

namespace EasyPrm\AddressBook\Contract;

/**
 * Interface AddressRepositoryInterface
 */
interface AddressRepositoryInterface
{
    public function save(AddressInterface $address): void;
    public function remove(AddressInterface $address): void;
    public function oneByIdentifier($identifier): ?AddressInterface;
}
