<?php

namespace Infrastructure\Database\Orm\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use EasyPrm\Partner\ValueObject\PartnerAccountNumber;

/**
 * Class PartnerAccountNumberType
 */
class PartnerAccountNumberType extends Type
{
    public const NAME = "partner_account_number";

    /**
     * @param PartnerAccountNumber $value
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

    public function convertToPHPValue($value, AbstractPlatform $platform): ?PartnerAccountNumber
    {
        if (!$value) {
            return null;
        }
        return PartnerAccountNumber::create($value);
    }

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
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
