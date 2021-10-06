<?php

namespace EasyPrm\Partner\Contract;

/**
 * Interface PartnerAccountRepositoryInterface
 */
interface PartnerAccountRepositoryInterface
{
    public function save(PartnerAccountInterface $partnerAccount): void;
    public function remove(PartnerAccountInterface $partnerAccount): void;
    public function oneByIdentifier($identifier): ?PartnerAccountInterface;
}
