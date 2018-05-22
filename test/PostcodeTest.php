<?php
namespace VasilDakov\Tests;

use VasilDakov\Postcode\PostcodeInterface;
use VasilDakov\Postcode\Postcode;

class PostcodeTest extends \PHPUnit_Framework_TestCase
{
    /** @var string $value */
    private $value;

    /** @var Postcode $postcode */
    private $postcode;


    public function setUp()
    {
        $this->value    = 'AA9A 9AA';
        $this->postcode = new Postcode($this->value);
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::__construct
     * @expectedException \VasilDakov\Postcode\Exception\InvalidArgumentException
     */
    public function constructorThrowsAnExceptions()
    {
        $this->postcode = new Postcode(1234.45);
    }


    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::__construct
     */
    public function postcodeCanBeConstructedWithValidData()
    {
        $value      = 'AA9A 9AA';
        $postcode   = new Postcode($value);

        self::assertInstanceOf(Postcode::class, $postcode);
    }


    public function testGetCode()
    {
        $value = 'TW1 3QS';
        $postcode = new Postcode($value);

        self::assertEquals($value, $postcode->toNative());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::normalise
     */
    public function canNormalizeString()
    {
        $value = 'TW13QS';
        $postcode = new Postcode($value);
        self::assertEquals('TW1 3QS', $postcode->normalise());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::equals
     */
    public function twoObjectsAreEquals()
    {
        $postcode1 = new Postcode('AA9A 9AA');
        $postcode2 = new Postcode('AA9A 9AA');

        self::assertTrue($postcode1->equals($postcode2));
        self::assertTrue($postcode2->equals($postcode1));
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::equals
     */
    public function twoObjectsAreNotEquals()
    {
        $postcode1 = new Postcode('AA9A 9AA');
        $postcode2 = new Postcode('BB9B 9BB');

        self::assertFalse($postcode1->equals($postcode2));
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::compareTo
     */
    public function canCompareTwoObjects()
    {
        $postcode1 = new Postcode('AA9A 9AA');
        $postcode2 = new Postcode('BB9B 9BB');

        self::assertFalse($postcode1->equals($postcode2));
    }


    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::outward
     */
    public function canReturnTheOutwardCode()
    {
        self::assertEquals('AA9A', $this->postcode->outward());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::outcode
     * @uses   \VasilDakov\Postcode\Postcode::outward
     */
    public function canReturnTheOutcode()
    {
        self::assertEquals('AA9A', $this->postcode->outcode());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::inward
     */
    public function canReturnTheInwardCode()
    {
        self::assertEquals('9AA', $this->postcode->inward());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::incode
     * @uses   \VasilDakov\Postcode\Postcode::inward
     */
    public function canReturnTheIncode()
    {
        self::assertEquals('9AA', $this->postcode->incode());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::area
     */
    public function canReturnTheAreaCode()
    {
        self::assertEquals('AA', $this->postcode->area());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::district
     */
    public function canReturnTheDistrictCode()
    {
        self::assertEquals('AA9', $this->postcode->district());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::subdistrict
     */
    public function canReturnSubDistrictCode()
    {
        self::assertEquals('AA9A', $this->postcode->subdistrict());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::sector
     */
    public function canReturnSectorCode()
    {
        self::assertEquals('AA9A 9', $this->postcode->sector());
    }

    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::unit
     */
    public function canReturnUnitCode()
    {
        self::assertEquals('AA', $this->postcode->unit());
    }


    public function testFromNative()
    {
        $postcode = Postcode::fromNative('TW8 8FB');

        self::assertInstanceOf(Postcode::class, $postcode);
    }


    public function testToNative()
    {
        self::assertEquals($this->value, $this->postcode->toNative());
    }


    /**
     * @test
     * @dataProvider postcodeProvider
     * @covers \VasilDakov\Postcode\Postcode::isValid
     */
    public function testIsValid($string, $expected)
    {
        self::assertEquals($expected, Postcode::isValid($string));
    }


    /**
     * @test
     */
    public function testToString()
    {
        $string = (string) $this->postcode;

        self::assertInternalType('string', $string);
        self::assertEquals($this->value, $string);
    }

    /**
     * @test
     */
    public function canBeSerialized()
    {
        $serialized = $this->postcode->serialize();

        self::assertInternalType('string', $serialized);
    }

    /**
     * @test
     */
    public function canBeUnserialized()
    {
        $serialized = $this->postcode->serialize();

        $value = $this->postcode->unserialize($serialized);

        self::assertEquals('AA9A 9AA', $value);
    }


    /**
     * @test
     */
    public function jsonSerialize()
    {
        $array = $this->postcode->jsonSerialize();

        self::assertInternalType('array', $array);

        self::assertArrayHasKey('postcode', $array);
    }


    /**
     * @test
     * @covers \VasilDakov\Postcode\Postcode::split
     * @uses   \VasilDakov\Postcode\Postcode::outward
     * @uses   \VasilDakov\Postcode\Postcode::inward
     * @uses   \VasilDakov\Postcode\Postcode::area
     * @uses   \VasilDakov\Postcode\Postcode::district
     * @uses   \VasilDakov\Postcode\Postcode::subdistrict
     * @uses   \VasilDakov\Postcode\Postcode::sector
     * @uses   \VasilDakov\Postcode\Postcode::unit
     */
    public function testSplit()
    {
        $array = $this->postcode->split();

        self::assertInternalType('array', $array);

        self::assertArrayHasKey('outward', $array);
        self::assertArrayHasKey('inward', $array);
        self::assertArrayHasKey('area', $array);
        self::assertArrayHasKey('district', $array);
        self::assertArrayHasKey('subdistrict', $array);
        self::assertArrayHasKey('sector', $array);
        self::assertArrayHasKey('unit', $array);


        self::assertEquals('AA9A', $array['outward']);
        self::assertEquals('9AA', $array['inward']);
        self::assertEquals('AA', $array['area']);
        self::assertEquals('AA9', $array['district']);
        self::assertEquals('AA9A 9', $array['sector']);
        self::assertEquals('AA', $array['unit']);
    }


    public function postcodeProvider()
    {
        return [
            ['EC1V 9LB', true],
            ['EC1V9LB',  true],
            ['TW8 8FB',  true],
            ['TW88FB',   true],
            ['ABC 123',  false],
            ['XYZ 987',  false],
            ['L70 2UD', true],
            ['GU28 0HH', true],
            ['XM4 5HQ', true],
            ['W1A 1AA', true],
            ['EC3V 0AS', true],
        ];
    }
}
