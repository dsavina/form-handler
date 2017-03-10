<?php
namespace Booya\Validator;

use Booya\Exception\InvalidFieldException;

/**
 * A validator to refuse null or empty value
 *
 * Class NotEmptyValidator
 * @package Booya\Validator
 */
class NotEmptyValidator extends AbstractValidator
{
    /**
     * @param mixed $value
     * @param mixed $contextObject
     *
     * @throws InvalidFieldException
     */
    public function validate($value, $contextObject = null)
    {
        if ($value === '' || $value === null || $value === []) {
            $this->throw();
        }
    }
}