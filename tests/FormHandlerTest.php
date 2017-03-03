<?php
namespace FormHandlerTest;

use FormHandler\Exception\FormException;
use FormHandler\FieldHandler\FieldHandler;
use FormHandler\FormHandler;
use FormHandler\Parser\IntParser;
use FormHandler\Parser\JsonEncoder;
use FormHandler\Parser\StringParser;
use FormHandler\Validator\NotEmptyValidator;

class FormHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @var FormHandler */
    private $formHandler;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->formHandler = new FormHandler([
                new FieldHandler('foo', new StringParser()),
                new FieldHandler('bar', new IntParser(), [new NotEmptyValidator()], true),
                new FieldHandler('baz', new IntParser()),
                new FieldHandler('qux', new JsonEncoder()),
            ]
        );
    }

//    public function testParseValidForm()
//    {
//        try {
//            $parsedData = $this->formHandler->parse([
//                'foo' => 'str',
//                'bar' => 13,
//                'baz' => '42',
//                'qux' => [
//                    'a' => 'b',
//                    'c' => new \DateTime('now')
//                ],
//            ]);
//            $this->assertTrue($parsedData['foo'] === 'str');
//            $this->assertTrue($parsedData['bar'] === 13);
//            $this->assertTrue($parsedData['baz'] === 42);
//        } catch (FormException $exception) {
//            self::assertTrue(false, 'form data was supposed to be valid!');
//        }
//    }
//
//    public function testCreateFromValidForm()
//    {
//        try {
//            /** @var FooBar $fooBar */
//            $fooBar = $this->formHandler->create([
//                'foo' => 'str',
//                'bar' => 13,
//                'baz' => ''
//            ], FooBar::class);
//            $this->assertTrue($fooBar->getFoo() === 'str');
//            $this->assertTrue($fooBar->getBar() === 13);
//            $this->assertTrue($fooBar->getBaz() === null);
//        } catch (FormException $exception) {
//            self::assertTrue(false, 'form data was supposed to be valid!');
//        }
//    }
//
//    public function testApplyValidForm()
//    {
//        try {
//            $fooBar = new FooBar();
//            $fooBar->setFoo('bla');
//            $fooBar->setBar(0);
//            $fooBar->setBaz(1);
//            $this->formHandler->apply([
//                'foo' => null,
//                'bar' => 13,
//                'baz' => '42'
//            ], $fooBar);
//            $this->assertTrue($fooBar->getFoo() === null);
//            $this->assertTrue($fooBar->getBar() === 13);
//            $this->assertTrue($fooBar->getBaz() === 42);
//        } catch (FormException $exception) {
//            self::assertTrue(false, 'form data was supposed to be valid!');
//        }
//    }

    public function testParseInvalidForm()
    {
        try {
            $this->formHandler->parse([
                'foo' => ['blah'],
                'baz' => '1.35',
                'qux' => new FooBar()
            ]);
            $this->assertTrue(false, 'form data was supposed to be INvalid!');
        } catch (FormException $exception) {
            self::assertTrue(true);
            $errorsMap = $exception->getErrorsMap();
            self::assertArrayHasKey('foo', $errorsMap);
            self::assertArrayHasKey('bar', $errorsMap);
        }
    }
}
