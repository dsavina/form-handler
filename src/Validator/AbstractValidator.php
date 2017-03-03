<?php

namespace FormHandler\Validator;

use FormHandler\Exception\InvalidFieldException;
use FormHandler\FieldError;

/**
 * An abstract validator throwing errors with fixed messages.
 *
 * Class AbstractValidator
 * @package FormHandler\Validator
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /** @var string */
    private $error;
    /** @return string */
    public function getError() { return $this->error; }

    /** @var string */
    private $details;
    /** @return string */
    public function getDetails() { return $this->details; }

    /**
     * AbstractValidator constructor.
     * @param string $error
     * @param string $details
     */
    public function __construct($error = "", $details = null)
    {
        $this->error = $error;
        $this->details = $details;
    }

    /**
     * @throws InvalidFieldException
     */
    protected function throw()
    {
        throw new InvalidFieldException(new FieldError($this->error, $this->details));
    }
}
