<?php

namespace EasyPrm\Core\Factory;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\IdentifierGeneratorInterface;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class IdentifierFactory
 */
class IdentifierFactory implements IdentifierFactoryInterface
{
    /** @var IdentifierGeneratorInterface */
    private $identifierGenerator;

    /**
     * IdentifierFactory constructor.
     *
     * @param IdentifierGeneratorInterface $identifierGenerator
     */
    public function __construct(IdentifierGeneratorInterface $identifierGenerator)
    {
        $this->identifierGenerator = $identifierGenerator;
    }

    public function create(): Identifier
    {
        return Identifier::create($this->identifierGenerator->generate());
    }
}
