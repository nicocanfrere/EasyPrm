<?php


namespace EasyPrm\Partner\Contract;

/**
 * Interface PartnerUserRepositoryInterface
 */
interface PartnerUserRepositoryInterface
{
    public function save(PartnerUserInterface $phoneNumberBook): void;
    public function remove(PartnerUserInterface $phoneNumberBook): void;
    public function oneByIdentifier($identifier): ?PartnerUserInterface;
}
