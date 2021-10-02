<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\ProductCatalog;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;
use EasyPrm\ProductCatalog\Price;

/**
 * Class PriceRepository
 */
class PriceRepository extends ServiceEntityRepository implements
    PriceRepositoryInterface
{
    /** @var TransliteratorInterface */
    private $transliterator;

    public function __construct(
        ManagerRegistry $registry,
        TransliteratorInterface $transliterator
    ) {
        parent::__construct($registry, Price::class);
        $this->transliterator = $transliterator;
    }

    public function save(PriceInterface $price): void
    {
        $this->_em->persist($price);
        $this->_em->flush();
    }

    public function remove(PriceInterface $price): void
    {
        $this->_em->remove($price);
        $this->_em->flush();
    }

    public function oneByIdentifier(Identifier $identifier): ?PriceInterface
    {
        $qb = $this->createQueryBuilder('price');
        $qb->andWhere('price.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function oneByLabel(string $label): ?PriceInterface
    {
        $alias = $this->transliterator->transliterate($label);
        $qb = $this->createQueryBuilder('price');
        $qb->andWhere('price.alias = :alias')->setParameter('alias', $alias);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
