<?php

namespace IntegerPacking\Test;

use IntegerPacking\IntegerQuartet;
use InvalidArgumentException;
use OutOfBoundsException;

class IntegerQuartetTest extends \PHPUnit_Framework_TestCase {

    public function testConstruct() {
        $validData = array(20, 30, 40, 50);
        $integerQuartet = new IntegerQuartet($validData[0], $validData[1], $validData[2], $validData[3]);
        $this->assertInstanceOf('\IntegerPacking\IntegerQuartet', $integerQuartet);
    }

    public function testEncodeDecodeValid(){
        $validData = array(
            array(20, 30, 40, 50),
            array(0, IntegerQuartet::MAX_16BIT_INTEGER_VALUE, 0, IntegerQuartet::MAX_16BIT_INTEGER_VALUE),
            array(IntegerQuartet::MAX_16BIT_INTEGER_VALUE, 0, IntegerQuartet::MAX_16BIT_INTEGER_VALUE, 0),
            array(IntegerQuartet::MAX_16BIT_INTEGER_VALUE, IntegerQuartet::MAX_16BIT_INTEGER_VALUE, IntegerQuartet::MAX_16BIT_INTEGER_VALUE, IntegerQuartet::MAX_16BIT_INTEGER_VALUE),
        );
        foreach ($validData as $i=>$data) {
            // Test encode
            $integerQuartet = new IntegerQuartet($data[0], $data[1], $data[2], $data[3]);
            $encodedInteger = $integerQuartet->get64bitInteger();
            $this->assertEquals($data[0],$integerQuartet->getIntegerA());
            $this->assertEquals($data[1],$integerQuartet->getIntegerB());
            $this->assertEquals($data[2],$integerQuartet->getIntegerC());
            $this->assertEquals($data[3],$integerQuartet->getIntegerD());
            $this->assertLessThanOrEqual(PHP_INT_MAX, $encodedInteger);
            $this->assertGreaterThanOrEqual(-(PHP_INT_MAX+1), $encodedInteger);
            // Test decode
            $decodedQuartet = IntegerQuartet::unpack($encodedInteger);
            $this->assertEquals($data[0],$decodedQuartet->getIntegerA());
            $this->assertEquals($data[1],$decodedQuartet->getIntegerB());
            $this->assertEquals($data[2],$decodedQuartet->getIntegerC());
            $this->assertEquals($data[3],$decodedQuartet->getIntegerD());
        }
    }

    public function testInvalidArgument() {
        $validData = array(
            array("a", null, "a", null),
            array(null, "a", null, "a"),
            array(1.23, 5.14, 1.23, 5.14),
        );
        foreach ($validData as $i=>$data) {
            try {
                new IntegerQuartet($data[0], $data[1], $data[2], $data[3]);
                $this->fail("Expected exception not thrown");
            } catch(InvalidArgumentException $e) {}
        }
    }

    public function testOutOfBounds() {
        $validData = array(
            array(-1, IntegerQuartet::MAX_16BIT_INTEGER_VALUE+1, -1, IntegerQuartet::MAX_16BIT_INTEGER_VALUE+1),
            array(IntegerQuartet::MAX_16BIT_INTEGER_VALUE+1, -1, IntegerQuartet::MAX_16BIT_INTEGER_VALUE+1, -1),
            array(-1, 0, 0, 0),
            array(0, -1, 0, 0),
            array(0, 0, -1, 0),
            array(0, 0, 0, -1),
        );
        foreach ($validData as $i=>$data) {
            try {
                new IntegerQuartet($data[0], $data[1], $data[2], $data[3]);
                $this->fail("Expected exception not thrown");
            } catch(OutOfBoundsException $e) {}
        }
    }
}