<?php


namespace EasyPrm\Partner\Contract;

use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\Partner\PartnerAccount;

/**
 * Interface PartnerAccountInterface
 */
interface PartnerAccountInterface
{

    public function setIdentifier(?Identifier $identifier): PartnerAccountInterface;

    public function getIdentifier(): ?Identifier;

    public function setAccountNumber(?string $accountNumber): PartnerAccountInterface;

    public function getAccountNumber(): ?string;

    public function setLabel(?string $label): PartnerAccountInterface;

    public function getLabel(): ?string;

    public function setCompanyNumber(?string $companyNumber): PartnerAccountInterface;

    public function getCompanyNumber(): ?string;
}
