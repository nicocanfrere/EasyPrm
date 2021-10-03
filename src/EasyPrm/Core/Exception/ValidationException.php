<?php

namespace EasyPrm\Core\Exception;

use Throwable;

/**
 * Class ValidationException
 */
class ValidationException extends \Exception implements \JsonSerializable
{
    protected $errors = [];

    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct('Not valid');
    }

    public function jsonSerialize(): array
    {
        return $this->errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
