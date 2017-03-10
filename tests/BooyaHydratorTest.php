<?php
namespace BooyaTest;

use Booya\Exception\HydratingException;
use Booya\HydratingHandler;
use Booya\BooyaHydrator;
use Booya\Parser\IntParser;
use Booya\Parser\JsonEncoder;
use Booya\Parser\StringParser;
use Booya\Validator\NotEmptyValidator;

class BooyaHydratorTest extends \PHPUnit_Framework_TestCase
{
    /** @var BooyaHydrator */
    private $hydrator;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->hydrator = new BooyaHydrator([
                new HydratingHandler('foo', new StringParser()),
                new HydratingHandler('bar', new IntParser(), [new NotEmptyValidator('This field is required')], true),
                new HydratingHandler('baz', new IntParser()),
                new HydratingHandler('qux', new JsonEncoder()),
            ]
        );
    }

    public function testCreateFromValidForm()
    {
        try {
            /** @var FooBar $fooBar */
            $fooBar = $this->hydrator->hydrateNewObject([
                'foo' => 'str',
                'bar' => 13,
                'baz' => ''
            ], FooBar::class);
            $this->assertTrue($fooBar->getFoo() === 'str');
            $this->assertTrue($fooBar->getBar() === 13);
            $this->assertTrue($fooBar->getBaz() === null);
        } catch (HydratingException $exception) {
            self::assertTrue(false, 'form data was supposed to be valid!');
        }
    }

    public function testApplyValidForm()
    {
        try {
            $fooBar = new FooBar();
            $fooBar->setFoo('bla');
            $fooBar->setBar(0);
            $fooBar->setBaz(1);
            $this->hydrator->hydrateObject([
                'foo' => null,
                'bar' => 13,
                'baz' => '42'
            ], $fooBar);
            $this->assertTrue($fooBar->getFoo() === null);
            $this->assertTrue($fooBar->getBar() === 13);
            $this->assertTrue($fooBar->getBaz() === 42);
        } catch (HydratingException $exception) {
            self::assertTrue(false, 'form data was supposed to be valid!');
        }
    }

    public function testParseInvalidForm()
    {
        try {
            $this->hydrator->hydrateNewObject([
                'foo' => ['blah'],
                'baz' => '1.35',
                'qux' => new FooBar()
            ], FooBar::class);
            $this->assertTrue(false, 'form data was supposed to be INvalid!');
        } catch (HydratingException $exception) {
            self::assertTrue(true);
            $errorsMap = $exception->getErrorsMap();
            self::assertArrayHasKey('foo', $errorsMap);
            self::assertArrayHasKey('bar', $errorsMap);
        }
    }
}
