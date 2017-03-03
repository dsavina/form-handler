<?php

namespace FormHandler;

use FormHandler\Exception\FormException;
use FormHandler\Exception\InvalidFieldException;
use FormHandler\FieldHandler\FieldHandlerInterface;
use Mouf\Hydrator\Hydrator;
use Mouf\Hydrator\TdbmHydrator;

/**
 * Class FormHandler
 * @package FormHandler
 */
class FormHandler implements FormHandlerInterface
{
    /** @var FieldHandlerInterface[] */
    private $fieldHandlers = [];

    /** @var Hydrator */
    private $hydrator;

    /**
     * FormHandler constructor.
     * @param FieldHandlerInterface[] $fieldHandlers
     * @param Hydrator $hydrator
     */
    public function __construct($fieldHandlers = [], $hydrator = null)
    {
        $this->fieldHandlers = $fieldHandlers;
        $this->hydrator = $hydrator ?? new TdbmHydrator();
    }

    /**
     * @param array $formData
     * @param mixed $target
     *
     * @throws FormException
     */
    public function apply($formData, &$target)
    {
        $parsedData = $this->parse($formData, $target);
        $this->hydrator->hydrateObject($parsedData, $target);
    }

    /**
     * @param array $formData
     * @param string $class
     * @return mixed
     *
     * @throws FormException
     */
    public function create($formData, $class)
    {
        $parsedData = $this->parse($formData);
        return $this->hydrator->hydrateNewObject($parsedData, $class);
    }

    public function parse($formData, $contextObject = null)
    {
        $parsedData = [];
        $errorsMap = [];
        foreach ($this->fieldHandlers as $fieldHandler) {
            if ($fieldHandler->isApplicable($formData)) {
                try {
                    $fieldHandler->extract($formData, $parsedData, $contextObject);
                } catch (InvalidFieldException $e) {
                    $errorsMap = array_merge($e->getInnerError(), $errorsMap);
                }
            }
        }
        foreach ($this->fieldHandlers as $fieldHandler) {
            if ($fieldHandler->isApplicable($formData)) {
                try {
                    $fieldHandler->validate($parsedData, $contextObject);
                } catch (InvalidFieldException $e) {
                    $errorsMap = array_merge($e->getInnerError(), $errorsMap);
                }
            }
        }

        if ($errorsMap) {
            throw new FormException($errorsMap);
        }

        return $parsedData;
    }
}