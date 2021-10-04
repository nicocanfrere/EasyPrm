<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\PhoneNumberBook;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberRepositoryInterface;
use EasyPrm\PhoneNumberBook\PhoneNumber;

/**
 * Class PhoneNumberRepository
 */
class PhoneNumberRepository extends ServiceEntityRepository implements
    PhoneNumberRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhoneNumber::class);
    }

    public function save(PhoneNumberInterface $phoneNumber): void
    {
        $this->_em->persist($phoneNumber);
        $this->_em->flush();
    }

    public function remove(PhoneNumberInterface $phoneNumber): void
    {
        $this->_em->remove($phoneNumber);
        $this->_em->flush();
    }

    public function oneByIdentifier($identifier): ?PhoneNumberInterface
    {
        $qb = $this->createQueryBuilder('phone_number');
        $qb->andWhere('phone_number.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
