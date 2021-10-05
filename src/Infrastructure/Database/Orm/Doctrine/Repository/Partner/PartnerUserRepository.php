<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\Partner;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\Partner\Contract\PartnerUserInterface;
use EasyPrm\Partner\Contract\PartnerUserRepositoryInterface;
use EasyPrm\Partner\PartnerUser;

/**
 * Class PartnerUserRepository
 */
class PartnerUserRepository extends ServiceEntityRepository implements
    PartnerUserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartnerUser::class);
    }

    public function save(PartnerUserInterface $partnerUser): void
    {
        $this->_em->persist($partnerUser);
        $this->_em->flush();
    }

    public function remove(PartnerUserInterface $partnerUser): void
    {
        $this->_em->remove($partnerUser);
        $this->_em->flush();
    }

    public function oneByIdentifier($identifier): ?PartnerUserInterface
    {
        $qb = $this->createQueryBuilder('partner_user');
        $qb->andWhere('partner_user.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
