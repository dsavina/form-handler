<?php
namespace FormHandlerTest\Parser;

use FormHandler\Exception\ParsingException;
use FormHandler\Parser\JsonEncoder;
use FormHandlerTest\FooBar;

class JsonEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testParseJson()
    {
        $parser = new JsonEncoder();

        $val = $parser->parse(['one' => 'two']);
        $this->assertTrue($val === '{"one":"two"}');

        try {
            $foo = new FooBar();
            $foo->setQux($foo);
            $parser->parse($foo);
            $this->assertTrue(false);
        } catch (ParsingException $exception) {
            $this->assertTrue(true);
        }

    }
}
