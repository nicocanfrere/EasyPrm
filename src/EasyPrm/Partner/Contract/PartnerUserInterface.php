<?php


namespace EasyPrm\Partner\Contract;

use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\Partner\PartnerUser;

/**
 * Interface PartnerUserInterface
 */
interface PartnerUserInterface
{

    public function getIdentifier(): ?Identifier;

    public function setIdentifier(?Identifier $identifier): PartnerUserInterface;

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
}
