<?php

namespace Application\Api\Partner\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use Application\Api\Partner\Dto\PartnerAccountInputDto;
use EasyPrm\Partner\PartnerAccount;

/**
 * Class PartnerAccountInputDtoDataTransformer
 */
class PartnerAccountInputDtoDataTransformer implements DataTransformerInterface
{
    public function transform($object, string $to, array $context = []): object
    {
        return $object;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return PartnerAccount::class === $to &&
               null !==  ($context['input']['class'] ?? null) &&
               $context['input']['class'] === PartnerAccountInputDto::class &&
               null !== ($context['collection_operation_name'] ?? null) &&
               $context['collection_operation_name'] === 'create'
            ;
    }
}
