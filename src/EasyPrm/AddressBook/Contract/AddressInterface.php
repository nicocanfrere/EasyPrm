<?php

namespace EasyPrm\AddressBook\Contract;

use EasyPrm\AddressBook\Address;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Interface AddressInterface
 */
interface AddressInterface
{

    public function getIdentifier(): ?Identifier;

    public function setIdentifier(?Identifier $identifier): AddressInterface;

    public function getAddressBook(): ?AddressBookInterface;

    public function setAddressBook(?AddressBookInterface $addressBook): AddressInterface;

    public function getLabel(): ?string;

    public function setLabel(?string $label): AddressInterface;

    public function getOwnerGender(): ?int;

    public function setOwnerGender(?int $ownerGender): AddressInterface;

    public function getOwnerFirstName(): ?string;

    public function setOwnerFirstName(?string $ownerFirstName): AddressInterface;

    public function getOwnerLastName(): ?string;

    public function setOwnerLastName(?string $ownerLastName): AddressInterface;

    public function getStreet(): ?string;

    public function setStreet(?string $street): AddressInterface;

    public function getComplementOne(): ?string;

    public function setComplementOne(?string $complementOne): AddressInterface;

    public function getComplementTwo(): ?string;

    public function setComplementTwo(?string $complementTwo): AddressInterface;

    public function getPostalCode(): ?string;

    public function setPostalCode(?string $postalCode): AddressInterface;

    public function getCity(): ?string;

    public function setCity(?string $city): AddressInterface;

    public function getRegion(): ?string;

    public function setRegion(?string $region): AddressInterface;

    public function getCountryCode(): ?string;

    public function setCountryCode(?string $countryCode): AddressInterface;
}
