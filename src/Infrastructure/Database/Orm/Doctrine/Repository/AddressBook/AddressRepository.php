<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\AddressBook;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\AddressBook\Address;
use EasyPrm\AddressBook\Contract\AddressInterface;
use EasyPrm\AddressBook\Contract\AddressRepositoryInterface;

/**
 * Class AddressRepository
 */
class AddressRepository extends ServiceEntityRepository implements
    AddressRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function save(AddressInterface $address): void
    {
        $this->_em->persist($address);
        $this->_em->flush();
    }

    public function remove(AddressInterface $address): void
    {
        $this->_em->remove($address);
        $this->_em->flush();
    }

    public function oneByIdentifier($identifier): ?AddressInterface
    {
        $qb = $this->createQueryBuilder('address');
        $qb->andWhere('address.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
