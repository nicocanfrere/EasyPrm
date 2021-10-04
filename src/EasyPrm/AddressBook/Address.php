<?php

namespace EasyPrm\AddressBook;

use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\AddressBook\Contract\AddressInterface;
use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class Address
 */
class Address implements AddressInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var AddressBookInterface|null */
    private $addressBook;
    /** @var string|null */
    private $label;
    /** @var int|null */
    private $ownerGender;
    /** @var string|null */
    private $ownerFirstName;
    /** @var string|null */
    private $ownerLastName;
    /** @var string|null */
    private $street;
    /** @var string|null */
    private $complementOne;
    /** @var string|null */
    private $complementTwo;
    /** @var string|null */
    private $city;
    /** @var string|null */
    private $postalCode;
    /** @var string|null */
    private $region;
    /** @var string|null */
    private $countryCode;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function setIdentifier(?Identifier $identifier): AddressInterface
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getAddressBook(): ?AddressBookInterface
    {
        return $this->addressBook;
    }

    public function setAddressBook(?AddressBookInterface $addressBook): AddressInterface
    {
        $this->addressBook = $addressBook;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): AddressInterface
    {
        $this->label = $label;

        return $this;
    }

    public function getOwnerGender(): ?int
    {
        return $this->ownerGender;
    }

    public function setOwnerGender(?int $ownerGender): AddressInterface
    {
        $this->ownerGender = $ownerGender;

        return $this;
    }

    public function getOwnerFirstName(): ?string
    {
        return $this->ownerFirstName;
    }

    public function setOwnerFirstName(?string $ownerFirstName): AddressInterface
    {
        $this->ownerFirstName = $ownerFirstName;

        return $this;
    }

    public function getOwnerLastName(): ?string
    {
        return $this->ownerLastName;
    }

    public function setOwnerLastName(?string $ownerLastName): AddressInterface
    {
        $this->ownerLastName = $ownerLastName;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): AddressInterface
    {
        $this->street = $street;

        return $this;
    }

    public function getComplementOne(): ?string
    {
        return $this->complementOne;
    }

    public function setComplementOne(?string $complementOne): AddressInterface
    {
        $this->complementOne = $complementOne;

        return $this;
    }

    public function getComplementTwo(): ?string
    {
        return $this->complementTwo;
    }

    public function setComplementTwo(?string $complementTwo): AddressInterface
    {
        $this->complementTwo = $complementTwo;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): AddressInterface
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): AddressInterface
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): AddressInterface
    {
        $this->region = $region;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): AddressInterface
    {
        $this->countryCode = $countryCode;

        return $this;
    }
}
