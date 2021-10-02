<?php

namespace EasyPrm\Tests\ProductCatalog\Repository;

use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Contract\ProductInterface;

/**
 * Class InMemoryProductRepository
 */
class InMemoryProductRepository implements \EasyPrm\ProductCatalog\Contract\ProductRepositoryInterface
{
    private $entities = [];
    /** @var TransliteratorInterface */
    private $transliterator;

    /**
     * InMemoryProductRepository constructor.
     *
     * @param TransliteratorInterface $transliterator
     */
    public function __construct(TransliteratorInterface $transliterator)
    {
        $this->transliterator = $transliterator;
    }

    public function save(ProductInterface $product): void
    {
        $this->entities[(string)$product->getIdentifier()] = $product;
    }

    public function remove(ProductInterface $product): void
    {
        $key = (string)$product->getIdentifier();
        if (array_key_exists($key, $this->entities)) {
            unset($this->entities[$key]);
        }
    }

    public function oneByIdentifier($identifier): ?ProductInterface
    {
        if ($identifier instanceof Identifier) {
            $identifier = (string)$identifier;
        }
        if (!is_string($identifier)) {
            throw new \InvalidArgumentException('Identifier is not string');
        }
        return array_key_exists($identifier, $this->entities) ? $this->entities[$identifier] : null;
    }

    public function oneByLabel(string $label): ?ProductInterface
    {
        $alias = $this->transliterator->transliterate($label);
        $search = array_values(array_filter($this->entities, function (ProductInterface $price) use ($alias) {
            return $price->getAlias() === $alias;
        }));
        $results = count($search);
        if ($results > 1) {
            throw new \Exception('non unique entity');
        }

        return $results === 1 ? $search[0] : null;
    }
}
