<?php

namespace EasyPrm\ProductCatalog\Repository;

use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\Core\ValueObject\Identifier;
use EasyPrm\ProductCatalog\Contract\PriceInterface;
use EasyPrm\ProductCatalog\Contract\PriceRepositoryInterface;

/**
 * Class InMemoryPriceRepository
 */
class InMemoryPriceRepository implements PriceRepositoryInterface
{
    private $entities = [];
    /** @var TransliteratorInterface */
    private $transliterator;

    /**
     * InMemoryPriceRepository constructor.
     *
     * @param TransliteratorInterface $transliterator
     */
    public function __construct(TransliteratorInterface $transliterator)
    {
        $this->transliterator = $transliterator;
    }

    public function save(PriceInterface $price): void
    {
        $this->entities[(string)$price->getIdentifier()] = $price;
    }

    public function remove(PriceInterface $price): void
    {
        $key = (string)$price->getIdentifier();
        if (array_key_exists($key, $this->entities)) {
            unset($this->entities[$key]);
        }
    }

    public function oneByIdentifier($identifier): ?PriceInterface
    {
        if ($identifier instanceof Identifier) {
            $identifier = (string)$identifier;
        }
        if (!is_string($identifier)) {
            throw new \InvalidArgumentException('Identifier is not string');
        }

        return array_key_exists($identifier, $this->entities) ? $this->entities[$identifier] : null;
    }

    public function oneByLabel(string $label): ?PriceInterface
    {
        $alias = $this->transliterator->transliterate($label);
        $search = array_values(array_filter($this->entities, function (PriceInterface $price) use ($alias) {
            return $price->getAlias() === $alias;
        }));
        $results = count($search);
        if ($results > 1) {
            throw new \Exception('non unique entity');
        }

        return $results === 1 ? $search[0] : null;
    }
}
