<?php
namespace Booya\Validator;

use Booya\Exception\InvalidFieldException;

/**
 * A validator should check the sanity of a value, given a context object, and throw an exception in case of failure.
 *
 * Interface ValidatorInterface
 * @package Booya\Validator
 */
interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @param $contextObject
     *
     * @throws InvalidFieldException
     */
    public function validate($value, $contextObject = null);
}
