<?php

namespace Application\Api\Partner\Dto;

/**
 * Class PartnerAccountInputDto
 */
class PartnerAccountInputDto
{
    /** @var string|null */
    private $label;
    /** @var string|null */
    private $companyNumber;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): PartnerAccountInputDto
    {
        $this->label = $label;

        return $this;
    }

    public function getCompanyNumber(): ?string
    {
        return $this->companyNumber;
    }

    public function setCompanyNumber(?string $companyNumber): PartnerAccountInputDto
    {
        $this->companyNumber = $companyNumber;

        return $this;
    }
}
