<?php

namespace EasyPrm\Partner\Contract;

use EasyPrm\Partner\Factory\PartnerAccountFactory;
use EasyPrm\Partner\PartnerAccount;

/**
 * Interface PartnerAccountFactoryInterface
 */
interface PartnerAccountFactoryInterface
{

    public function create(string $label, ?string $companyNumber = null): PartnerAccountInterface;
}
