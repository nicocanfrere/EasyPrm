<?php

namespace EasyPrm\Partner\Contract;

use EasyPrm\Partner\ValueObject\PartnerAccountNumber;

/**
 * Interface PartnerAccountNumberFactoryInterface
 */
interface PartnerAccountNumberFactoryInterface
{

    public function create(): PartnerAccountNumber;
}
