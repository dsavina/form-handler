<?php
namespace FormHandler\Parser;

use FormHandler\Exception\ParsingException;

/**
 * A parser handling primitive input values.
 *
 * Interface ParserInterface
 * @package FormHandler\Parser
 */
interface ParserInterface
{
    /**
     * @param $rawValue
     * @return mixed
     *
     * @throws ParsingException
     */
    public function parse($rawValue);
}
