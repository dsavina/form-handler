<?php
namespace Booya\Parser;

use Booya\Exception\ParsingException;

/**
 * Class AbstractParser
 * @package Booya\Parser
 */
class AbstractParser
{
    /** @var mixed */
    private $error;
    /** @return string */
    public function getError() { return $this->error; }

    /**
     * AbstractValidator constructor.
     * @param mixed $error
     */
    public function __construct($error = "")
    {
        $this->error = $error;
    }

    /**
     * @throws ParsingException
     */
    protected function throw()
    {
        throw new ParsingException($this->error);
    }
}