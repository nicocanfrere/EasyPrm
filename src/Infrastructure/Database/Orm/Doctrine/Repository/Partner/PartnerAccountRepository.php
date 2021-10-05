<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\Partner;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use EasyPrm\Partner\Contract\PartnerAccountRepositoryInterface;
use EasyPrm\Partner\PartnerAccount;

/**
 * Class PartnerAccountRepository
 */
class PartnerAccountRepository extends ServiceEntityRepository implements
    PartnerAccountRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartnerAccount::class);
    }

    public function save(PartnerAccountInterface $partnerAccount): void
    {
        $this->_em->persist($partnerAccount);
        $this->_em->flush();
    }

    public function remove(PartnerAccountInterface $partnerAccount): void
    {
        $this->_em->remove($partnerAccount);
        $this->_em->flush();
    }

    public function oneByIdentifier($identifier): ?PartnerAccountInterface
    {
        $qb = $this->createQueryBuilder('partner_account');
        $qb->andWhere('partner_account.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
