<?php

namespace EasyPrm\Partner\Contract;

/**
 * Interface PartnerUserRepositoryInterface
 */
interface PartnerUserRepositoryInterface
{
    public function save(PartnerUserInterface $partnerUser): void;
    public function remove(PartnerUserInterface $partnerUser): void;
    public function oneByIdentifier($identifier): ?PartnerUserInterface;
}
