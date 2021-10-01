<?php

namespace Infrastructure\Database\Orm\Doctrine\Repository\ProductCatalog;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\ProductCatalog\Contract\ProductInterface;
use EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface;
use EasyPrm\ProductCatalog\Product;

/**
 * Class ProductRepository
 */
class ProductRepository extends ServiceEntityRepository implements
    ProductRepositoryInterface
{
    /** @var TransliteratorInterface */
    private $transliterator;

    public function __construct(
        ManagerRegistry $registry,
        TransliteratorInterface $transliterator
    ) {
        parent::__construct($registry, Product::class);
        $this->transliterator = $transliterator;
    }

    public function save(ProductInterface $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

    public function remove(ProductInterface $product): void
    {
        $this->_em->remove($product);
        $this->_em->flush();
    }

    public function oneByIdentifier($identifier): ?ProductInterface
    {
        $qb = $this->createQueryBuilder('product');
        $qb->andWhere('product.identifier = :identifier')->setParameter('identifier', $identifier);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function oneByLabel(string $label): ?ProductInterface
    {
        $alias = $this->transliterator->transliterate($label);
        $qb = $this->createQueryBuilder('product');
        $qb->andWhere('product.alias = :alias')->setParameter('alias', $alias);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
