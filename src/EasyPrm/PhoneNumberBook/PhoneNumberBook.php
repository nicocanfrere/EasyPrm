<?php

namespace EasyPrm\PhoneNumberBook;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberInterface;

/**
 * Class PhoneBook
 */
class PhoneNumberBook implements PhoneNumberBookInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var Collection<PhoneNumberInterface> */
    private $numbers;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
        $this->numbers = new ArrayCollection();
    }

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier;
    }

    public function setIdentifier(?Identifier $identifier): PhoneNumberBookInterface
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getNumbers()
    {
        return $this->numbers;
    }

    public function setNumbers($numbers): PhoneNumberBookInterface
    {
        $this->numbers = $numbers;

        return $this;
    }

    public function addNumber(PhoneNumberInterface $number): PhoneNumberBookInterface
    {
        if (!$this->numbers->contains($number)) {
            $this->numbers->add($number);
            $number->setPhoneNumberBook($this);
        }

        return $this;
    }

    public function removeNumber(PhoneNumberInterface $number): PhoneNumberBookInterface
    {
        if ($this->numbers->contains($number)) {
            $this->numbers->removeElement($number);
            $number->setPhoneNumberBook(null);
        }

        return $this;
    }
}
