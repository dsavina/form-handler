<?php
namespace FormHandler\Validator;

use FormHandler\Exception\InvalidFieldException;

/**
 * A validator to refuse null or empty value
 *
 * Class NotEmptyValidator
 * @package FormHandler\Validator
 */
class NotEmptyValidator extends AbstractValidator
{
    /**
     * @param mixed $value
     * @param array $parsedData
     * @param mixed $contextObject
     *
     * @throws InvalidFieldException
     */
    public function validate($value, $parsedData, $contextObject)
    {
        if ($value === '' || $value === null || $value === []) {
            $this->throw();
        }
    }
}