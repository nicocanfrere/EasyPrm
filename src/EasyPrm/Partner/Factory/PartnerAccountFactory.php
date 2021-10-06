<?php

namespace EasyPrm\Partner\Factory;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\Core\Contract\TransliteratorInterface;
use EasyPrm\Partner\Contract\PartnerAccountFactoryInterface;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use EasyPrm\Partner\Contract\PartnerAccountNumberFactoryInterface;
use EasyPrm\Partner\PartnerAccount;

/**
 * Class PartnerAccountFactory
 */
class PartnerAccountFactory implements PartnerAccountFactoryInterface
{
    /** @var IdentifierFactoryInterface */
    private $identifierFactory;
    /** @var TransliteratorInterface */
    private $transliterator;
    /** @var PartnerAccountNumberFactoryInterface */
    private $partnerAccountNumberFactory;

    /**
     * PartnerAccountFactory constructor.
     *
     * @param IdentifierFactoryInterface $identifierFactory
     * @param PartnerAccountNumberFactoryInterface $partnerAccountNumberFactory
     * @param TransliteratorInterface $transliterator
     */
    public function __construct(
        IdentifierFactoryInterface $identifierFactory,
        PartnerAccountNumberFactoryInterface $partnerAccountNumberFactory,
        TransliteratorInterface $transliterator
    ) {
        $this->identifierFactory = $identifierFactory;
        $this->transliterator    = $transliterator;
        $this->partnerAccountNumberFactory = $partnerAccountNumberFactory;
    }

    public function create(
        string $label,
        ?string $companyNumber = null
    ): PartnerAccountInterface {
        $partnerAccount = new PartnerAccount();
        $partnerAccount
            ->setIdentifier($this->identifierFactory->create())
            ->setLabel($label)
            ->setAlias($this->transliterator->transliterate($label))
            ->setCompanyNumber($companyNumber)
            ->setAccountNumber($this->partnerAccountNumberFactory->create())
            ;

        return $partnerAccount;
    }
}
