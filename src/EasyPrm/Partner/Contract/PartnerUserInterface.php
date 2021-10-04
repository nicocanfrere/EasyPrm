<?php


namespace EasyPrm\Partner\Contract;

use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\PhoneBook\Contract\PhoneBookInterface;

/**
 * Interface PartnerUserInterface
 */
interface PartnerUserInterface
{

    public function getIdentifier(): ?Identifier;

    public function setIdentifier(?Identifier $identifier): PartnerUserInterface;

    public function getAccountNumber(): ?string;

    public function setAccountNumber(?string $accountNumber): PartnerUserInterface;

    public function getGender(): ?int;

    public function setGender(?int $gender): PartnerUserInterface;

    public function getFirstName(): ?string;

    public function setFirstName(?string $firstName): PartnerUserInterface;

    public function getLastName(): ?string;

    public function setLastName(?string $lastName): PartnerUserInterface;

    public function getEmail(): ?string;

    public function setEmail(?string $email): PartnerUserInterface;

    public function getPartnerAccount(): ?PartnerAccountInterface;

    public function setPartnerAccount(?PartnerAccountInterface $partnerAccount): PartnerUserInterface;

    public function getAddressBook(): ?AddressBookInterface;

    public function setAddressBook(?AddressBookInterface $addressBook): PartnerUserInterface;

    public function getPhoneBook(): ?PhoneBookInterface;

    public function setPhoneBook(?PhoneBookInterface $phoneBook): PartnerUserInterface;
}
