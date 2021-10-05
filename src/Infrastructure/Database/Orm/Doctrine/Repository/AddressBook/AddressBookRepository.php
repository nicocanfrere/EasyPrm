<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\AddressBook;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\AddressBook\AddressBook;
use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\AddressBook\Contract\AddressBookRepositoryInterface;

/**
 * Class AddressBookRepository
 */
class AddressBookRepository extends ServiceEntityRepository implements
    AddressBookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressBook::class);
    }

    public function save(AddressBookInterface $addressBook): void
    {
        $this->_em->persist($addressBook);
        $this->_em->flush();
    }

    public function remove(AddressBookInterface $addressBook): void
    {
        $this->_em->remove($addressBook);
        $this->_em->flush();
    }

    public function oneByIdentifier($identifier): ?AddressBookInterface
    {
        $qb = $this->createQueryBuilder('address_book');
        $qb->andWhere('address_book.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
