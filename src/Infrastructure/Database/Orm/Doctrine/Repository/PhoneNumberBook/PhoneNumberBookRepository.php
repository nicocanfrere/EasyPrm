<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\PhoneNumberBook;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookRepositoryInterface;
use EasyPrm\PhoneNumberBook\PhoneNumberBook;

/**
 * Class PhoneNumberBookRepository
 */
class PhoneNumberBookRepository extends ServiceEntityRepository implements
    PhoneNumberBookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhoneNumberBook::class);
    }

    public function save(PhoneNumberBookInterface $phoneNumberBook): void
    {
        $this->_em->persist($phoneNumberBook);
        $this->_em->flush();
    }

    public function remove(PhoneNumberBookInterface $phoneNumberBook): void
    {
        $this->_em->remove($phoneNumberBook);
        $this->_em->flush();
    }

    public function oneByIdentifier($identifier): ?PhoneNumberBookInterface
    {
        $qb = $this->createQueryBuilder('phone_number_book');
        $qb->andWhere('phone_number_book.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
