<?php

namespace EasyPrm\AddressBook\Contract;

use EasyPrm\AddressBook\AddressBook;
use EasyPrm\AddressBook\Factory\AddressBookFactory;

interface AddressBookFactoryInterface
{

    public function create(): AddressBookInterface;
}
