<?php

namespace EasyPrm\Partner\Event;

use EasyPrm\Core\Event\Event;
use EasyPrm\Partner\Contract\PartnerAccountInterface;

/**
 * Class PartnerAccountCreatedEvent
 */
class PartnerAccountCreatedEvent extends Event
{
    /** @var PartnerAccountInterface */
    private $partnerAccount;

    /**
     * PartnerAccountCreatedEvent constructor.
     *
     * @param PartnerAccountInterface $partnerAccount
     */
    public function __construct(PartnerAccountInterface $partnerAccount)
    {
        $this->partnerAccount = $partnerAccount;
    }

    /**
     * @return PartnerAccountInterface
     */
    public function getPartnerAccount(): PartnerAccountInterface
    {
        return $this->partnerAccount;
    }
}
