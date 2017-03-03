<?php
namespace FormHandler\FieldHandler;

use FormHandler\Exception\InvalidFieldException;

/**
 * An interface describing the methods needed for being used in class FieldHandler
 *
 * Interface FieldHandlerInterface
 * @package FormHandler\FieldHandler
 */
interface FieldHandlerInterface
{
    /**
     * @param array $formData
     * @return bool
     */
    public function isApplicable($formData);

    /**
     * @param array $formData
     * @param array $targetData
     * @param mixed $contextObject
     *
     * @throws InvalidFieldException
     */
    public function extract($formData, &$targetData, $contextObject = null);

    /**
     * @param array $parsedData
     * @param mixed $contextObject
     *
     * @throws InvalidFieldException

     */
    public function validate($parsedData, $contextObject = null);
}
