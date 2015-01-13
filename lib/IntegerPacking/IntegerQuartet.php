<?php

namespace IntegerPacking;

use RuntimeException;
use OutOfBoundsException;

/**
 * Class IntegerQuartet
 *
 * Allows you to pack four 16bit signed integers into a 64bit one (in reality they're all 64bit, by 16bit we mean integers
 * that can be represented with 16bits).
 *
 * DEMO USAGE
 *      From 3 16bit integers:
 *          $integerQuartet = new \IntegerPacking\IntegerQuartet(20,30,40,50);
 *          echo $integerQuartet->get64bitInteger(); // prints the 64 bit integer that combines the 4 16bit integers
 *
 *      From 1 64bit integer:
 *          $integerQuartet = \IntegerPacking\IntegerQuartet::unpack( 5629628385853490 );
 *          echo "A: ".$integerQuartet->getIntegerA()." - B: ".$integerQuartet->getIntegerB()." - C: ".$integerQuartet->getIntegerC()." - D: ".$integerQuartet->getIntegerD();
 *
 * NOTICE: Your system must support 64bit integers (PHP_INT_SIZE === 8)
 *
 * @author http://www.github.com/rmruano
 * @license https://raw.githubusercontent.com/rmruano/PHPIntegerQuartet/master/LICENSE
 * @package Rmruano
 */
class IntegerQuartet {

    const MAX_16BIT_INTEGER_VALUE = 32767;
    const MASK_16BIT = 0x000000000000ffff;

    protected $integer16bitA = 0;
    protected $integer16bitB = 0;
    protected $integer16bitC = 0;
    protected $integer16bitD = 0;
    protected $integer64bit = 0;

    /**
     * Packs 2 16bit integers into one 64bit integer
     * @param $integer16bitA    16bit integer   (it's really a 64bit one)
     * @param $integer16bitB    16bit integer   (it's really a 64bit one)
     * @param $integer16bitC    16bit integer   (it's really a 64bit one)
     * @param $integer16bitD    16bit integer   (it's really a 64bit one)
     * @throws OutOfBoundsException parameters exceeds the capacity of a 16bit integer
     * @throws RuntimeException unsupported
     */
    public function __construct($integer16bitA, $integer16bitB, $integer16bitC, $integer16bitD) {
        if (PHP_INT_SIZE < 8 || PHP_INT_MAX<=static::MAX_16BIT_INTEGER_VALUE) {
            throw new RuntimeException("Your system doesn't support 64bit integers");
        }
        foreach (array("A","B","C","D") as $intNum) {
            if (${"integer16bit".$intNum} > static::MAX_16BIT_INTEGER_VALUE || ${"integer16bit".$intNum} < 0) {
                throw new OutOfBoundsException("Integer".$intNum." exceeds the 16bit range [0 to " .
                    static::MAX_16BIT_INTEGER_VALUE . "]: ".${"integer16bit".$intNum}." provided");
            }
        }
        $this->integer16bitA = $integer16bitA;
        $this->integer16bitB = $integer16bitB;
        $this->integer16bitC = $integer16bitC;
        $this->integer16bitD = $integer16bitD;
        $this->integer64bit = $integer16bitA<<48 | $integer16bitB<<32 | $integer16bitC<<16 | $integer16bitD;
    }

    /**
     * Unpacks a 64bit integer into 4 16 bit integers (they're really 64bit as well)
     * @param $integer64bit
     * @return IntegerQuartet
     */
    public static function unpack($integer64bit) {
        $integer16bitA = $integer64bit>>48;
        $integer16bitB = $integer64bit>>32 & self::MASK_16BIT;
        $integer16bitC = $integer64bit>>16 & self::MASK_16BIT;
        $integer16bitD = $integer64bit & self::MASK_16BIT;
        return new IntegerQuartet($integer16bitA, $integer16bitB, $integer16bitC, $integer16bitD);
    }

    /**
     * Returns the 16bit A integer   (it's really a 64bit one)
     * @return int
     */
    public function getIntegerA() {
        return $this->integer16bitA;
    }

    /**
     * Returns the 16bit B integer   (it's really a 64bit one)
     * @return int
     */
    public function getIntegerB() {
        return $this->integer16bitB;
    }

    /**
     * Returns the 16bit C integer   (it's really a 64bit one)
     * @return int
     */
    public function getIntegerC() {
        return $this->integer16bitC;
    }

    /**
     * Returns the 16bit D integer   (it's really a 64bit one)
     * @return int
     */
    public function getIntegerD() {
        return $this->integer16bitD;
    }

    /**
     * Returns the 64bit packed integer
     * @return int
     */
    public function get64bitInteger() {
        return $this->integer64bit;
    }

}