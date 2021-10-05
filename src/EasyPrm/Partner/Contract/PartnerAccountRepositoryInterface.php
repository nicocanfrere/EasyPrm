<?php


namespace EasyPrm\Partner\Contract;

/**
 * Interface PartnerAccountRepositoryInterface
 */
interface PartnerAccountRepositoryInterface
{
    public function save(PartnerAccountInterface $phoneNumberBook): void;
    public function remove(PartnerAccountInterface $phoneNumberBook): void;
    public function oneByIdentifier($identifier): ?PartnerAccountInterface;
}
