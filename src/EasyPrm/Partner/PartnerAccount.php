<?php

namespace EasyPrm\Partner;

use EasyPrm\Core\Contract\TimestampableTrait;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\Partner\Contract\PartnerAccountInterface;

/**
 * Class PartnerAccount
 */
class PartnerAccount implements PartnerAccountInterface
{
    use TimestampableTrait;

    /** @var Identifier|null */
    private $identifier;
    /** @var string|null */
    private $label;
    /** @var string|null */
    private $companyNumber;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): PartnerAccountInterface
    {
        $this->label = $label;

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
}
