<?php

namespace EasyPrm\PhoneNumberBook;

use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberInterface;

/**
 * Class PhoneNumber
 */
class PhoneNumber implements PhoneNumberInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var string|null */
    private $number;
    /** @var PhoneNumberBookInterface */
    private $phoneNumberBook;
    /** @var string|null */
    private $label;
    /** @var int|null */
    private $ownerGender;
    /** @var string|null */
    private $ownerFirstName;
    /** @var string|null */
    private $ownerLastName;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function setIdentifier(?Identifier $identifier): PhoneNumberInterface
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): PhoneNumberInterface
    {
        $this->number = $number;

        return $this;
    }

    public function getPhoneNumberBook(): PhoneNumberBookInterface
    {
        return $this->phoneNumberBook;
    }

    public function setPhoneNumberBook(PhoneNumberBookInterface $phoneNumberBook): PhoneNumberInterface
    {
        $this->phoneNumberBook = $phoneNumberBook;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): PhoneNumberInterface
    {
        $this->label = $label;

        return $this;
    }

    public function getOwnerGender(): ?int
    {
        return $this->ownerGender;
    }

    public function setOwnerGender(?int $ownerGender): PhoneNumberInterface
    {
        $this->ownerGender = $ownerGender;

        return $this;
    }

    public function getOwnerFirstName(): ?string
    {
        return $this->ownerFirstName;
    }

    public function setOwnerFirstName(?string $ownerFirstName): PhoneNumberInterface
    {
        $this->ownerFirstName = $ownerFirstName;

        return $this;
    }

    public function getOwnerLastName(): ?string
    {
        return $this->ownerLastName;
    }

    public function setOwnerLastName(?string $ownerLastName): PhoneNumberInterface
    {
        $this->ownerLastName = $ownerLastName;

        return $this;
    }
}
