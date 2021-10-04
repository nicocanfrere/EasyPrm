<?php

namespace EasyPrm\Partner;

use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use EasyPrm\Partner\Contract\PartnerUserInterface;
use EasyPrm\PhoneBook\Contract\PhoneBookInterface;

/**
 * Class PartnerUser
 */
class PartnerUser implements PartnerUserInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var string|null */
    private $accountNumber;
    /** @var int|null */
    private $gender;
    /** @var string|null */
    private $firstName;
    /** @var string|null */
    private $lastName;
    /** @var string|null */
    private $email;
    /** @var PartnerAccountInterface|null */
    private $partnerAccount;
    /** @var AddressBookInterface|null */
    private $addressBook;
    /** @var PhoneBookInterface|null */
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

    public function setIdentifier(?Identifier $identifier): PartnerUserInterface
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(?string $accountNumber): PartnerUserInterface
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): PartnerUserInterface
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): PartnerUserInterface
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): PartnerUserInterface
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): PartnerUserInterface
    {
        $this->email = $email;

        return $this;
    }

    public function getPartnerAccount(): ?PartnerAccountInterface
    {
        return $this->partnerAccount;
    }

    public function setPartnerAccount(?PartnerAccountInterface $partnerAccount): PartnerUserInterface
    {
        $this->partnerAccount = $partnerAccount;

        return $this;
    }

    public function getAddressBook(): ?AddressBookInterface
    {
        return $this->addressBook;
    }

    public function setAddressBook(?AddressBookInterface $addressBook): PartnerUserInterface
    {
        $this->addressBook = $addressBook;

        return $this;
    }

    public function getPhoneBook(): ?PhoneBookInterface
    {
        return $this->phoneBook;
    }

    public function setPhoneBook(?PhoneBookInterface $phoneBook): PartnerUserInterface
    {
        $this->phoneBook = $phoneBook;

        return $this;
    }
}
