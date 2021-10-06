<?php

namespace EasyPrm\PhoneNumberBook\Factory;

use EasyPrm\Core\Contract\IdentifierFactoryInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookFactoryInterface;
use EasyPrm\PhoneNumberBook\Contract\PhoneNumberBookInterface;
use EasyPrm\PhoneNumberBook\PhoneNumberBook;

/**
 * Class PhoneNumberBookFactory
 */
class PhoneNumberBookFactory implements PhoneNumberBookFactoryInterface
{
    /** @var IdentifierFactoryInterface */
    private $identifierFactory;

    /**
     * PhoneBookFactory constructor.
     *
     * @param IdentifierFactoryInterface $identifierFactory
     */
    public function __construct(IdentifierFactoryInterface $identifierFactory)
    {
        $this->identifierFactory = $identifierFactory;
    }

    public function create(): PhoneNumberBookInterface
    {
        $phoneNumberBook = new PhoneNumberBook();
        $phoneNumberBook->setIdentifier($this->identifierFactory->create());

        return $phoneNumberBook;
    }
}
