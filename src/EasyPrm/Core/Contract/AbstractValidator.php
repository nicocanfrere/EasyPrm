<?php

namespace EasyPrm\Core\Contract;

use EasyPrm\Core\Exception\ValidationException;

/**
 * Class AbstractValidator
 */
class AbstractValidator implements ValidatorInterface
{
    /** @var array<ValidationSpecificationInterface> */
    protected $rules = [];
    /** @var array */
    protected $errors = [];

    public function addRule(ValidationSpecificationInterface $specification): ValidatorInterface
    {
        $this->rules[] = $specification;

        return $this;
    }

    public function validate($object)
    {
        foreach ($this->rules as $rule) {
            if (! $rule->isSatisfiedBy($object)) {
                $this->errors[] = $rule->getError();
            }
        }

        if (count($this->errors) !== 0) {
            throw new ValidationException($this->errors);
        }
    }
}
