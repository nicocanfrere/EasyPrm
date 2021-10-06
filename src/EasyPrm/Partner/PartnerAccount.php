<?php

namespace EasyPrm\Partner;

use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use EasyPrm\Partner\ValueObject\PartnerAccountNumber;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookInterface;

/**
 * Class PartnerAccount
 */
class PartnerAccount implements PartnerAccountInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var PartnerAccountNumber|null */
    private $accountNumber;
    /** @var string|null */
    private $label;
    /** @var string|null */
    private $alias;
    /** @var string|null */
    private $companyNumber;
    /** @var AddressBookInterface|null */
    private $addressBook;
    /** @var PhoneNumberBookInterface|null */
    private $phoneBook;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function setIdentifier(?Identifier $identifier): PartnerAccountInterface
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getAccountNumber(): ?PartnerAccountNumber
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(?PartnerAccountNumber $accountNumber): PartnerAccountInterface
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): PartnerAccountInterface
    {
        $this->label = $label;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): PartnerAccountInterface
    {
        $this->alias = $alias;

        return $this;
    }

    public function getCompanyNumber(): ?string
    {
        return $this->companyNumber;
    }

    public function setCompanyNumber(?string $companyNumber): PartnerAccountInterface
    {
        $this->companyNumber = $companyNumber;

        return $this;
    }

    public function getAddressBook(): ?AddressBookInterface
    {
        return $this->addressBook;
    }

    public function setAddressBook(?AddressBookInterface $addressBook): PartnerAccountInterface
    {
        $this->addressBook = $addressBook;

        return $this;
    }

    public function getPhoneBook(): ?PhoneNumberBookInterface
    {
        return $this->phoneBook;
    }

    public function setPhoneBook(?PhoneNumberBookInterface $phoneBook): PartnerAccountInterface
    {
        $this->phoneBook = $phoneBook;

        return $this;
    }
}
