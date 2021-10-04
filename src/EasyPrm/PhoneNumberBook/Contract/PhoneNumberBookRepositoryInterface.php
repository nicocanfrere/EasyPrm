<?php

namespace EasyPrm\PhoneNumberBook\Contract;

/**
 * Interface PhoneNumberBookRepositoryInterface
 */
interface PhoneNumberBookRepositoryInterface
{
    public function save(PhoneNumberBookInterface $phoneNumberBook): void;
    public function remove(PhoneNumberBookInterface $phoneNumberBook): void;
    public function oneByIdentifier($identifier): ?PhoneNumberBookInterface;
}
