<?php

namespace EasyPrm\AddressBook;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\AddressBook\Contract\AddressInterface;
use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class AddressBook
 */
class AddressBook implements AddressBookInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var Collection<AddressInterface> */
    private $addresses;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
        $this->addresses = new ArrayCollection();
    }

    public function setAddresses($addresses): AddressBookInterface
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function addAddress(AddressInterface $address): AddressBookInterface
    {
        if (! $this->addresses->contains($address)) {
            $this->addresses->add($address);
            $address->setAddressBook($this);
        }

        return $this;
    }

    public function getAddresses()
    {
        return $this->addresses;
    }

    public function removeAddress(AddressInterface $address): AddressBookInterface
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            $address->setAddressBook(null);
        }

        return $this;
    }

    public function setIdentifier(?Identifier $identifier): AddressBookInterface
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }
}
