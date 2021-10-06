<?php

namespace EasyPrm\Partner\Contract;

use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\Partner\PartnerAccount;
use EasyPrm\Partner\ValueObject\PartnerAccountNumber;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookInterface;

/**
 * Interface PartnerAccountInterface
 */
interface PartnerAccountInterface
{

    public function setIdentifier(?Identifier $identifier): PartnerAccountInterface;

    public function getIdentifier(): ?Identifier;

    public function setAccountNumber(?PartnerAccountNumber $accountNumber): PartnerAccountInterface;

    public function getAccountNumber(): ?PartnerAccountNumber;

    public function setLabel(?string $label): PartnerAccountInterface;

    public function getLabel(): ?string;

    public function getAlias(): ?string;

    public function setAlias(?string $alias): PartnerAccountInterface;

    public function setCompanyNumber(?string $companyNumber): PartnerAccountInterface;

    public function getCompanyNumber(): ?string;

    public function getAddressBook(): ?AddressBookInterface;

    public function setAddressBook(?AddressBookInterface $addressBook): PartnerAccountInterface;

    public function getPhoneBook(): ?PhoneNumberBookInterface;

    public function setPhoneBook(?PhoneNumberBookInterface $phoneBook): PartnerAccountInterface;
}
