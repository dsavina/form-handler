<?php
namespace Booya;

use Booya\Exception\HydratingException;
use Booya\Exception\InvalidFieldException;
use Booya\Validator\ValidatorInterface;
use Mouf\Hydrator\Hydrator;
use Mouf\Hydrator\TdbmHydrator;

/**
 * An implementation of Hydrator interface, designed to be configured as will per instance.
 *
 * Class BooyaHydrator
 * @package Booya
 */
class BooyaHydrator implements Hydrator
{
    /** @var HydratingHandlerInterface[] */
    private $handlers = [];

    /** @var ValidatorInterface[] */
    private $validators = [];

    /** @var Hydrator */
    private $simpleHydrator;

    /**
     * BooyaHydrator constructor.
     * @param HydratingHandlerInterface[] $handlers
     * @param ValidatorInterface[] $validators
     * @param Hydrator $simpleHydrator
     */
    public function __construct($handlers = [], $validators = [], $simpleHydrator = null)
    {
        $this->handlers = $handlers;
        $this->validators = $validators;
        $this->simpleHydrator = $simpleHydrator ?? new TdbmHydrator();
    }

    /**
     * @param array $data
     * @param $object
     * @return object
     *
     * @throws HydratingException
     */
    public function hydrateObject(array $data, $object)
    {
        $parsedData = $this->parse($data, $object);
        $this->simpleHydrator->hydrateObject($parsedData, $object);
        return $object;
    }

    /**
     * @param array $data
     * @param string $class
     * @return object
     *
     * @throws HydratingException
     */
    public function hydrateNewObject(array $data, string $className)
    {
        $parsedData = $this->parse($data);
        return $this->simpleHydrator->hydrateNewObject($parsedData, $className);
    }

    /**
     * @param $data
     * @param $contextObject
     * @return array
     *
     * @throws HydratingException
     */
    private function parse($data, $contextObject = null)
    {
        $parsedData = [];
        $errorsMap = [];

        foreach ($this->handlers as $fieldHandler) {
            try {
                $fieldHandler->handle($data, $parsedData, $contextObject);
            } catch (HydratingException $e) {
                $errorsMap = array_merge($e->getErrorsMap(), $errorsMap);
            }
        }

        foreach ($this->validators as $validator) {
            try {
                $validator->validate($parsedData, $contextObject);
            } catch (InvalidFieldException $e) {
                $errorsMap = array_merge($e->getInnerError(), $errorsMap);
            }
        }

        if ($errorsMap) {
            throw new HydratingException($errorsMap);
        }

        return $parsedData;
    }
}