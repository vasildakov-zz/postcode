<?php
namespace VasilDakov\Tests;

use VasilDakov\Postcode\Validator;
use VasilDakov\Postcode\PostcodeInterface;
use VasilDakov\Postcode\Postcode;

class PostcodeTest extends \PHPUnit_Framework_TestCase
{
    /** @var mixed $value */
    private $value;


    /** @var Postcode $postcode */
    private $postcode;


    /** @var Validator $validator */
    private $validator;


    public function setUp()
    {
        $this->value     = 'AA9A 9AA';
        $this->validator = new Validator('UK');
        $this->postcode  = new Postcode($this->value, $this->validator);
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::__construct
     * @expectedException \VasilDakov\Postcode\Exception\InvalidArgumentException
     */
    public function constructorThrowsAnExceptions()
    {
        $this->postcode = new Postcode(1234.45, $this->validator);
    }


    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::__construct
     */
    public function postcodeCanBeConstructedWithValidData()
    {
        $value      = 'AA9A 9AA';
        $postcode   = new Postcode($value, $this->validator);

        self::assertInstanceOf(Postcode::class, $postcode);
    }


    public function testGetCode()
    {
        $value = 'TW1 3QS';

        $postcode = new Postcode($value, $this->validator);

        self::assertEquals($value, $postcode->toString());
    }


    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::equals
     */
    public function twoObjectsAreEquals()
    {
        $postcode1 = new Postcode('AA9A 9AA', $this->validator);
        $postcode2 = new Postcode('AA9A 9AA', $this->validator);

        self::assertTrue($postcode1->equals($postcode2));
        self::assertTrue($postcode2->equals($postcode1));
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::equals
     */
    public function twoObjectsAreNotEquals()
    {
        $postcode1 = new Postcode('AA9A 9AA', $this->validator);
        $postcode2 = new Postcode('BB9B 9BB', $this->validator);

        self::assertFalse($postcode1->equals($postcode2));
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::compareTo
     */
    public function canBeComparedWithOtherObject()
    {
        $postcode1 = new Postcode('AA9A 9AA', $this->validator);
        $postcode2 = new Postcode('BB9B 9BB', $this->validator);

        self::assertFalse($postcode1->equals($postcode2));
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::toString
     * @covers \VasilDakov\Postcode\Postcode::__toString
     */
    public function canBeConvertedToString()
    {
        self::assertEquals($this->value, $this->postcode->toString());

        self::assertEquals($this->value, (string)$this->postcode);
    }


    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::serialize
     */
    public function canBeSerialized()
    {
        $serialized = $this->postcode->serialize();

        self::assertInternalType('string', $serialized);
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::unserialize
     */
    public function canBeUnserialized()
    {
        $serialized = $this->postcode->serialize();

        $value = $this->postcode->unserialize($serialized);

        self::assertEquals('AA9A 9AA', $value);
    }


    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::jsonSerialize
     */
    public function jsonSerialize()
    {
        $array = $this->postcode->jsonSerialize();

        self::assertInternalType('array', $array);

        self::assertArrayHasKey('postcode', $array);
    }
}
