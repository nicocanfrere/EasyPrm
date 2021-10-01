<?php

namespace Infrastructure\Database\Orm\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use EasyPrm\Core\ValueObject\Identifier;

/**
 * Class IdentifierType
 */
class IdentifierType extends Type
{
    public const NAME = "identifier";

    /**
     * @param Identifier $value
     * @param AbstractPlatform $platform
     *
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        $value = (string)$value;
        if ($value === "") {
            return null;
        }
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Identifier
    {
        if (!$value) {
            return null;
        }
        return Identifier::create($value);
    }

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @param AbstractPlatform $platform
     *
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
