<?php

namespace IntegerPacking\Test;

use IntegerPacking\IntegerPair;
use InvalidArgumentException;
use OutOfBoundsException;

class IntegerPairTest extends \PHPUnit_Framework_TestCase {

    public function testConstruct() {
        $validData = array(20, 30);
        $integerPair = new IntegerPair($validData[0], $validData[1]);
        $this->assertInstanceOf('\IntegerPacking\IntegerPair', $integerPair);
    }

    public function testEncodeDecodeValid(){
        $validData = array(
            array(20, 30),
            array(-20, -30),
            array(-(IntegerPair::MAX_32BIT_INTEGER_VALUE+1), IntegerPair::MAX_32BIT_INTEGER_VALUE),
            array(IntegerPair::MAX_32BIT_INTEGER_VALUE, -(IntegerPair::MAX_32BIT_INTEGER_VALUE+1)),
        );
        foreach ($validData as $i=>$data) {
            // Test encode
            $integerPair = new IntegerPair($data[0], $data[1]);
            $encodedInteger = $integerPair->get64bitInteger();
            $this->assertEquals($data[0],$integerPair->getIntegerA());
            $this->assertEquals($data[1],$integerPair->getIntegerB());
            $this->assertLessThanOrEqual(PHP_INT_MAX, $encodedInteger);
            $this->assertGreaterThanOrEqual(-(PHP_INT_MAX+1), $encodedInteger);
            // Test decode
            $decodedPair = IntegerPair::unpack($encodedInteger);
            $this->assertEquals($data[0],$decodedPair->getIntegerA());
            $this->assertEquals($data[1],$decodedPair->getIntegerB());
        }
    }

    public function testInvalidArgument() {
        $validData = array(
            array("a", null),
            array(null, "a"),
            array(1.23, 5.14),
        );
        foreach ($validData as $i=>$data) {
            try {
                new IntegerPair($data[0], $data[1]);
                $this->fail("Expected exception not thrown");
            } catch(InvalidArgumentException $e) {}
        }
    }

    public function testOutOfBounds() {
        $validData = array(
            array(-(IntegerPair::MAX_32BIT_INTEGER_VALUE+1)-1, IntegerPair::MAX_32BIT_INTEGER_VALUE+1),
            array(IntegerPair::MAX_32BIT_INTEGER_VALUE+1, -(IntegerPair::MAX_32BIT_INTEGER_VALUE+1)-1),
        );
        foreach ($validData as $i=>$data) {
            try {
                new IntegerPair($data[0], $data[1]);
                $this->fail("Expected exception not thrown");
            } catch(OutOfBoundsException $e) {}
        }
    }
}