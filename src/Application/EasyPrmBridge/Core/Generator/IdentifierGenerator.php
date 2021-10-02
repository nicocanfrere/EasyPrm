<?php

namespace Application\EasyPrmBridge\Core\Generator;

use EasyPrm\Core\Contract\IdentifierGeneratorInterface;
use Symfony\Component\Uid\Uuid;

/**
 * Class IdentifierGenerator
 */
class IdentifierGenerator implements IdentifierGeneratorInterface
{
    public function generate(): string
    {
        return Uuid::v4()->toRfc4122();
    }
}
