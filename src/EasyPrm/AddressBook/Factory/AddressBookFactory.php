<?php

namespace EasyPrm\AddressBook\Factory;

use EasyPrm\AddressBook\AddressBook;
use EasyPrm\AddressBook\Contract\AddressBookFactoryInterface;
use EasyPrm\AddressBook\Contract\AddressBookInterface;
use EasyPrm\Core\Contract\IdentifierFactoryInterface;

/**
 * Class AddressBookFactory
 */
class AddressBookFactory implements AddressBookFactoryInterface
{
    /** @var IdentifierFactoryInterface */
    private $identifierFactory;

    /**
     * AddressBookFactory constructor.
     *
     * @param IdentifierFactoryInterface $identifierFactory
     */
    public function __construct(IdentifierFactoryInterface $identifierFactory)
    {
        $this->identifierFactory = $identifierFactory;
    }

    public function create(): AddressBookInterface
    {
        $addressBook = new AddressBook();
        $addressBook->setIdentifier($this->identifierFactory->create());

        return $addressBook;
    }
}
