<?php

namespace Booya\Parser;

use Booya\Exception\ParsingException;

/**
 * Class IntParser
 * @package Booya\Parser
 */
class IntParser implements ParserInterface
{
    /**
     * @param $rawValue
     * @return mixed
     *
     * @throws ParsingException
     */
    public function parse($rawValue)
    {
        if ($rawValue === null || $rawValue === '') {
            return null;
        } else if (!is_int($rawValue) && !ctype_digit($rawValue)) {
            throw new ParsingException('Invalid value');
        } else {
            return intval($rawValue);
        }
    }
}