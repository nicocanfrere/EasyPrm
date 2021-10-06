<?php

namespace EasyPrm\Partner\Command\PartnerAccount;

/**
 * Class CreateCommand
 */
class CreateCommand
{
    /** @var string|null */
    private $label;
    /** @var string|null */
    private $companyNumber;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): CreateCommand
    {
        $this->label = $label;

        return $this;
    }

    public function getCompanyNumber(): ?string
    {
        return $this->companyNumber;
    }

    public function setCompanyNumber(?string $companyNumber): CreateCommand
    {
        $this->companyNumber = $companyNumber;

        return $this;
    }
}
