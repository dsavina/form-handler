<?php
namespace FormHandler;

/**
 * A descriptor for a specific failure in form data parsing/validation.
 *
 * Class FieldError
 * @package FormHandler
 */
class FieldError implements \JsonSerializable
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
     * FieldError constructor.
     * @param string $error
     * @param string $details
     */
    public function __construct($error = null, $details = null)
    {
        $this->error = $error;
        $this->details = $details;
    }

    /**
     * @return array
     */
    function jsonSerialize()
    {
        return [
            'error' => $this->error,
            'details' => $this->details
        ];
    }
}
