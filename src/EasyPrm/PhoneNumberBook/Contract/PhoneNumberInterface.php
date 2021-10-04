<?php

namespace EasyPrm\PhoneNumberBook\Contract;

use EasyPrm\Core\ValueObject\Identifier;

/**
 * Interface PhoneNumberInterface
 */
interface PhoneNumberInterface
{

    public function getPhoneNumberBook(): PhoneNumberBookInterface;

    public function getNumber(): ?string;

    public function getOwnerLastName(): ?string;

    public function setLabel(?string $label): PhoneNumberInterface;

    public function getOwnerGender(): ?int;

    public function getLabel(): ?string;

    public function setIdentifier(?Identifier $identifier): PhoneNumberInterface;

    public function getOwnerFirstName(): ?string;

    public function setNumber(?string $number): PhoneNumberInterface;

    public function getIdentifier(): ?Identifier;

    public function setOwnerGender(?int $ownerGender): PhoneNumberInterface;

    public function setOwnerLastName(?string $ownerLastName): PhoneNumberInterface;

    public function setOwnerFirstName(?string $ownerFirstName): PhoneNumberInterface;

    public function setPhoneNumberBook(PhoneNumberBookInterface $phoneNumberBook): PhoneNumberInterface;
}
