<?php

namespace EasyPrm\Partner\Builder;

use EasyPrm\AddressBook\Contract\AddressBookFactoryInterface;
use EasyPrm\AddressBook\Contract\AddressBookRepositoryInterface;
use EasyPrm\Partner\Contract\PartnerAccountBuilderInterface;
use EasyPrm\Partner\Contract\PartnerAccountFactoryInterface;
use EasyPrm\Partner\Contract\PartnerAccountInterface;
use EasyPrm\Partner\Contract\PartnerAccountRepositoryInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookFactoryInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookRepositoryInterface;

/**
 * Class PartnerAccountBuilder
 */
class PartnerAccountBuilder implements PartnerAccountBuilderInterface
{
    /** @var PartnerAccountFactoryInterface */
    private $partnerAccountFactory;
    /** @var PartnerAccountRepositoryInterface  */
    private $partnerAccountRepository;
    /** @var PhoneNumberBookFactoryInterface */
    private $phoneNumberBookFactory;
    /** @var PhoneNumberBookRepositoryInterface */
    private $phoneNumberBookRepository;
    /** @var AddressBookFactoryInterface */
    private $addressBookFactory;
    /** @var AddressBookRepositoryInterface */
    private $addressBookRepository;

    /**
     * PartnerAccountBuilder constructor.
     *
     * @param PartnerAccountFactoryInterface $partnerAccountFactory
     * @param PartnerAccountRepositoryInterface $partnerAccountRepository
     * @param PhoneNumberBookFactoryInterface $phoneNumberBookFactory
     * @param PhoneNumberBookRepositoryInterface $phoneNumberBookRepository
     * @param AddressBookFactoryInterface $addressBookFactory
     * @param AddressBookRepositoryInterface $addressBookRepository
     */
    public function __construct(
        PartnerAccountFactoryInterface $partnerAccountFactory,
        PartnerAccountRepositoryInterface $partnerAccountRepository,
        PhoneNumberBookFactoryInterface $phoneNumberBookFactory,
        PhoneNumberBookRepositoryInterface $phoneNumberBookRepository,
        AddressBookFactoryInterface $addressBookFactory,
        AddressBookRepositoryInterface $addressBookRepository
    ) {
        $this->partnerAccountFactory     = $partnerAccountFactory;
        $this->phoneNumberBookFactory    = $phoneNumberBookFactory;
        $this->phoneNumberBookRepository = $phoneNumberBookRepository;
        $this->addressBookFactory        = $addressBookFactory;
        $this->addressBookRepository     = $addressBookRepository;
        $this->partnerAccountRepository = $partnerAccountRepository;
    }

    public function build(
        string $label,
        ?string $companyNumber = null
    ): PartnerAccountInterface {
        $partnerAccount = $this->partnerAccountFactory->create($label, $companyNumber);
        $this
            ->addPhoneNumberBook($partnerAccount)
            ->addAddressBook($partnerAccount)
        ;
        $this->partnerAccountRepository->save($partnerAccount);

        return $partnerAccount;
    }

    public function addPhoneNumberBook(PartnerAccountInterface $partnerAccount): PartnerAccountBuilderInterface
    {
        $phoneNumberBook = $this->phoneNumberBookFactory->create();
        $this->phoneNumberBookRepository->save($phoneNumberBook);
        $partnerAccount->setPhoneBook($phoneNumberBook);

        return $this;
    }

    public function addAddressBook(PartnerAccountInterface $partnerAccount): PartnerAccountBuilderInterface
    {
        $addressBook = $this->addressBookFactory->create();
        $this->addressBookRepository->save($addressBook);
        $partnerAccount->setAddressBook($addressBook);

        return $this;
    }
}
