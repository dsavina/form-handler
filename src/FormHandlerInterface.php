<?php
namespace FormHandler;

use FormHandler\Exception\FormException;

/**
 * A handler for instantiating or editing objects out of raw data (array of primitive values or recursively same structure).
 *
 * Interface FormHandlerInterface
 * @package FormHandler
 */
interface FormHandlerInterface
{
    /**
     * @param array $formData
     * @param string $class
     * @return mixed
     *
     * @throws FormException
     */
    public function create($formData, $class);

    /**
     * @param array $formData
     * @param mixed $target
     *
     * @throws FormException
     */
    public function apply($formData, &$target);
}
