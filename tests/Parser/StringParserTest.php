<?php
/**
 * Created by PhpStorm.
 * User: dorian
 * Date: 03/03/17
 * Time: 18:57
 */

namespace FormHandlerTest\Parser;


use FormHandler\Parser\StringParser;


class StringParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParseString()
    {
        $parser = new StringParser();

        $val = $parser->parse('foo');
        $val = $parser->parse(42);
        $val = $parser->parse(4.2);
    }
}
