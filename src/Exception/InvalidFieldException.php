<?php
namespace FormHandler\Exception;

use FormHandler\FieldError;

/**
 * An exception describing why some data was considered invalid.
 *
 * Class InvalidFieldException
 * @package FormHandler\Exception
 */
class InvalidFieldException extends \Exception
{
    /** @var mixed */
    private $innerError;
    /** @return mixed */
    public function getInnerError() { return $this->innerError; }

    /**
     * InvalidFieldException constructor.
     * @param FieldError|array $innerError
     * @param string $message
     * @param int $code
     */
    public function __construct($innerError, $message = "", $code = 0)
    {
        parent::__construct($message, $code, null);
        $this->innerError = $innerError;
    }
}
