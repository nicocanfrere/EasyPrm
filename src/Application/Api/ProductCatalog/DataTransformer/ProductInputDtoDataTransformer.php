<?php

namespace Application\Api\ProductCatalog\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use EasyPrm\ProductCatalog\Product;

/**
 * Class ProductInputDtoDataTransformer
 */
class ProductInputDtoDataTransformer implements DataTransformerInterface
{

    public function transform($object, string $to, array $context = [])
    {
        return $object;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Product::class === $to && null !==  ($context['input']['class'] ?? null);
    }
}
