<?php

namespace EasyPrm\PhoneNumberBook\Contract;

/**
 * Interface PhoneNumberRepositoryInterface
 */
interface PhoneNumberRepositoryInterface
{
    public function save(PhoneNumberInterface $phoneNumber): void;
    public function remove(PhoneNumberInterface $phoneNumber): void;
    public function oneByIdentifier($identifier): ?PhoneNumberInterface;
}
