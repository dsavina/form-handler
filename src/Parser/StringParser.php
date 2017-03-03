<?php
namespace FormHandler\Parser;

use FormHandler\Exception\ParsingException;

/**
 * Class StringParser
 * @package FormHandler\Parser
 */
class StringParser implements ParserInterface
{
    /**
     * @param $rawValue
     * @return mixed
     *
     * @throws ParsingException
     */
    public function parse($rawValue)
    {
        if ($rawValue === null) {
            return null;
        } else if (is_array($rawValue)) {
            throw new ParsingException('Invalid value');
        } else {
            return strval($rawValue);
        }
    }
}