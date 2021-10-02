<?php

namespace Infrastructure\Database\Orm\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use EasyPrm\ProductCatalog\ValueObject\Amount;

/**
 * Class AmountType
 */
class AmountType extends Type
{
    public const NAME = "amount";

    /**
     * @param Amount $value
     * @param AbstractPlatform $platform
     *
     * @return int|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value->getRawValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Amount
    {
        if (!$value) {
            return null;
        }
        return Amount::fromRawValue($value);
    }

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getBigIntTypeDeclarationSQL($fieldDeclaration);
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
