<?php
namespace Booya;

use Booya\ErrorMessage\DetailedErrorMessage;
use Booya\Exception\HydratingException;
use Booya\Exception\InvalidFieldException;
use Booya\Exception\ParsingException;
use Booya\Parser\ParserInterface;
use Booya\Validator\ValidatorInterface;

/**
 * An implementation of FieldHandlerInterface, as a one to one value parsing/validation.
 *
 * Class HydratingHandler
 * @package BooyaHydrator\FieldHandler
 */
class HydratingHandler implements HydratingHandlerInterface
{
    /** @var string */
    private $key;

    /** @var ParserInterface */
    private $parser;

    /** @var ValidatorInterface[] */
    private $validators;

    /**
     * HydratingHandler constructor.
     * @param string $key
     * @param ParserInterface $parser
     * @param ValidatorInterface[] $validators
     */
    public function __construct($key, $parser, $validators = [])
    {
        $this->key = $key;
        $this->parser = $parser;
        $this->validators = $validators;
    }

    /**
     * @param array $data
     * @param array $targetData
     * @param null $object
     *
     * @throws HydratingException
     */
    public function handle(array $data, array &$targetData, $object = null)
    {
        if (array_key_exists($this->key, $data)) {
            $rawValue = $data[$this->key];
        } else if ($object === null) {
            $rawValue = null;
        } else {
            return;
        }

        try {
            $targetData[$this->key] = $this->parser->parse($rawValue);
        } catch (ParsingException $exception) {
            throw new HydratingException([ $this->key => new DetailedErrorMessage($exception->getMessage()) ]);
        }

        $this->validate($targetData, $object);
    }

    /**
     * @param array $parsedData
     * @param mixed $contextObject
     *
     * @throws HydratingException
     */
    private function validate($parsedData, $contextObject = null)
    {
        try {
            foreach ($this->validators as $validator) {
                $validator->validate($parsedData[$this->key]);
            }
        } catch (InvalidFieldException $exception) {
            throw new HydratingException([ $this->key => $exception->getInnerError() ]);
        }
    }
}
