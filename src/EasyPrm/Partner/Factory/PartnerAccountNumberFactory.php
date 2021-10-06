<?php

namespace EasyPrm\Partner\Factory;

use EasyPrm\Partner\Contract\PartnerAccountNumberFactoryInterface;
use EasyPrm\Partner\ValueObject\PartnerAccountNumber;

/**
 * Class PartnerAccountNumberFactory
 */
class PartnerAccountNumberFactory implements PartnerAccountNumberFactoryInterface
{
    public function create(): PartnerAccountNumber
    {
        return PartnerAccountNumber::create(uniqid());
    }
}
