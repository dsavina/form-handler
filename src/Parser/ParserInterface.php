<?php
namespace Booya\Parser;

use Booya\Exception\ParsingException;

/**
 * A parser handling primitive input values.
 *
 * Interface ParserInterface
 * @package Booya\Parser
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
