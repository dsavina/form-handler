<?php
namespace FormHandler\Validator;

use FormHandler\Exception\InvalidFieldException;

/**
 * A validator checking the sanity of a value.
 *
 * Interface ValidatorInterface
 * @package FormHandler\Validator
 */
interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @param array $parsedData
     * @param mixed $contextObject
     *
     * @throws InvalidFieldException
     */
    public function validate($value, $parsedData, $contextObject);
}
