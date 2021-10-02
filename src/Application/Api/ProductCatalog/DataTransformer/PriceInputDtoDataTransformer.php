<?php

namespace Application\Api\ProductCatalog\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use EasyPrm\ProductCatalog\Price;

/**
 * Class PriceInputDto
 */
class PriceInputDtoDataTransformer implements DataTransformerInterface
{

    public function transform($object, string $to, array $context = [])
    {
        //TODO validation
        return $object;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Price::class === $to && null !==  ($context['input']['class'] ?? null);
    }
}
