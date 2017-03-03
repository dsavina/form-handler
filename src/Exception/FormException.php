<?php
namespace FormHandler\Exception;

/**
 * An exception containing the mapping of various errors in a form data.
 *
 * Class FormException
 * @package FormHandler\Exception
 */
class FormException extends \Exception
{
    /** @var array */
    private $errorsMap;
    /** @return array */
    public function getErrorsMap() { return $this->errorsMap; }

    /**
     * FormException constructor.
     * All the leaves of errors map should be instances of FieldError.
     *
     * @param array $errorsMap
     * @param string $message
     * @param int $code
     */
    public function __construct($errorsMap, $message = "", $code = 412)
    {
        parent::__construct($message, $code, null);
        $this->errorsMap = $errorsMap;
    }
}
