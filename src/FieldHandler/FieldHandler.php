<?php

namespace FormHandler\FieldHandler;

use FormHandler\Exception\InvalidFieldException;
use FormHandler\Exception\ParsingException;
use FormHandler\FieldError;
use FormHandler\Parser\ParserInterface;
use FormHandler\Validator\ValidatorInterface;

/**
 * An implementation of FieldHandlerInterface, as a one to one value parsing/validation
 *
 * Class FieldHandler
 * @package FormHandler\FieldHandler
 */
class FieldHandler implements FieldHandlerInterface
{
    /** @var string */
    private $key;

    /** @var ParserInterface */
    private $parser;

    /** @var ValidatorInterface[] */
    private $validators;

    /** @var bool  */
    private $isMandatory;

    /**
     * FieldHandler constructor.
     * @param string $key
     * @param ParserInterface $parser
     * @param ValidatorInterface[] $validators
     */
    public function __construct($key, $parser, $validators = [], $isMandatory = false)
    {
        $this->key = $key;
        $this->parser = $parser;
        $this->validators = $validators;
        $this->isMandatory = $isMandatory;
    }

    /**
     * @param array $formData
     * @return bool
     */
    public function isApplicable($formData)
    {
        return $this->isMandatory || array_key_exists($this->key, $formData);
    }

    /**
     * @param $formData
     * @param array $targetData
     * @param $contextObject
     *
     * @throws InvalidFieldException
     */
    public function extract($formData, &$targetData, $contextObject = null)
    {
        $rawValue = array_key_exists($this->key, $formData) ? $formData[$this->key] : null;
        try {
            $parsedValue = $this->parser->parse($rawValue);
        } catch (ParsingException $exception) {
            throw new InvalidFieldException([ $this->key => new FieldError($exception->getMessage()) ]);
        }

        $targetData[$this->key] = $parsedValue;
    }

    /**
     * @param array $parsedData
     * @param mixed $contextObject
     *
     * @throws InvalidFieldException
     */
    public function validate($parsedData, $contextObject = null)
    {
        try {
            foreach ($this->validators as $validator) {
                if (array_key_exists($this->key, $parsedData)) {
                    $validator->validate($parsedData[$this->key], $parsedData, $contextObject);
                }
            }
        } catch (InvalidFieldException $exception) {
            throw new InvalidFieldException([ $this->key => $exception->getInnerError() ]);
        }
    }
}
