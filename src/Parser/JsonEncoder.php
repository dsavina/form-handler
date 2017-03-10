<?php

namespace Booya\Parser;

use Booya\Exception\ParsingException;

/**
 * Class JsonEncoder
 * @package Booya\Parser
 */
class JsonEncoder implements ParserInterface
{
    /** @var int */
    private $options;

    /**
     * JsonParser constructor.
     * @param int $options
     */
    public function __construct($options = 0)
    {
        $this->options = $options;
    }

    /**
     * @param $rawValue
     * @return string
     *
     * @throws ParsingException
     */
    public function parse($rawValue)
    {
        $json = json_encode($rawValue, $this->options);
        if ($json === false) {
            throw new ParsingException(json_last_error_msg());
        } else {
            return $json;
        }
    }
}
