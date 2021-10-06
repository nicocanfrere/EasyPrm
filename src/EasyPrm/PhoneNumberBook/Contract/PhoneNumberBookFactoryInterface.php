<?php

namespace EasyPrm\PhoneNumberBook\Contract;

use EasyPrm\PhoneNumberBook\Factory\PhoneNumberBookFactory;
use EasyPrm\PhoneNumberBook\PhoneNumberBook;

/**
 * Interface PhoneNumberBookFactoryInterface
 */
interface PhoneNumberBookFactoryInterface
{

    public function create(): PhoneNumberBookInterface;
}
