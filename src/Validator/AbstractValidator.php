<?php
namespace Booya\Validator;

use Booya\Exception\InvalidFieldException;

/**
 * An abstract validator throwing errors with fixed messages.
 *
 * Class AbstractValidator
 * @package Booya\Validator
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /** @var mixed */
    private $errorMessage;
    /** @return string */
    public function getErrorMessage() { return $this->errorMessage; }

    /**
     * AbstractValidator constructor.
     * @param mixed $errorMessage
     */
    public function __construct($errorMessage = "")
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @throws InvalidFieldException
     */
    protected function throw()
    {
        throw new InvalidFieldException($this->errorMessage);
    }
}
