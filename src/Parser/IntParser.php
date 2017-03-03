<?php

namespace FormHandler\Parser;

use FormHandler\Exception\ParsingException;

/**
 * Class IntParser
 * @package FormHandler\Parser
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