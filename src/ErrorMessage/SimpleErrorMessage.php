<?php
namespace Booya\ErrorMessage;

use Mouf\Utils\Value\ValueInterface;

/**
 * A simple descriptor for a specific failure in form data parsing/validation.
 *
 * Class SimpleErrorMessage
 * @package Booya\ErrorMessage
 */
class SimpleErrorMessage implements \JsonSerializable
{
    /** @var string|ValueInterface */
    private $message = "";
    /** @return string */
    public function getMessage() { return $this->message; }
    /** @param string $message */
    public function setMessage($message) { $this->message = $message; }

    /**
     * FieldError constructor.
     * @Important
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    function jsonSerialize()
    {
        return $this->message;
    }
}
