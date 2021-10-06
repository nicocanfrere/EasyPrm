<?php

namespace EasyPrm\Partner\Contract;

use EasyPrm\Partner\Builder\PartnerAccountBuilder;

/**
 * Interface PartnerAccountBuilderInterface
 */
interface PartnerAccountBuilderInterface
{

    public function build(string $label, ?string $companyNumber = null): PartnerAccountInterface;

    public function addAddressBook(PartnerAccountInterface $partnerAccount): PartnerAccountBuilderInterface;

    public function addPhoneNumberBook(PartnerAccountInterface $partnerAccount): PartnerAccountBuilderInterface;
}
