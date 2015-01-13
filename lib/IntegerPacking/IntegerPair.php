<?php

namespace IntegerPacking;

use RuntimeException;
use OutOfBoundsException;

/**
 * Class IntegerPair
 *
 * Allows you to pack two 32bit signed integers into a 64bit one (in reality they're all 64bit, by 32 bits we mean integers
 * that can be represented with 32bits).
 *
 * DEMO USAGE
 *      From 2 32bit integers:
 *          $integerPair = new \IntegerPacking\IntegerPair(20,30);
 *          echo $integerPair->get64bitInteger(); // prints the 64 bit integer that combines the 2 32bit integers
 *
 *      From 1 64bit integer:
 *          $integerPair = \IntegerPacking\IntegerPair::unpack( 85899345950 );
 *          echo "A: ".$integerPair->getIntegerA()." - B: ".$integerPair->getIntegerB();
 *
 * NOTICE: Your system must support 64bit integers (PHP_INT_SIZE === 8)
 *
 * @author http://www.github.com/rmruano
 * @license https://raw.githubusercontent.com/rmruano/integer-packing/master/LICENSE
 * @package Rmruano
 */
class IntegerPair {

    const MAX_32BIT_INTEGER_VALUE = 2147483647;
    const MASK_32BIT = 0x00000000ffffffff;

    protected $integer32bitA = 0;
    protected $integer32bitB = 0;
    protected $integer64bit = 0;

    /**
     * Packs 2 32bit integers into one 64bit integer
     * @param $integer32bitA    32bit integer   (it's really a 64bit one)
     * @param $integer32bitB    32bit integer   (it's really a 64bit one)
     * @throws OutOfBoundsException parameters exceeds the capacity of a 32bit integer
     * @throws RuntimeException unsupported
     */
    public function __construct($integer32bitA, $integer32bitB) {
        if (PHP_INT_SIZE < 8 || PHP_INT_MAX<=static::MAX_32BIT_INTEGER_VALUE) {
            throw new RuntimeException("Your system doesn't support 64bit integers");
        }
        foreach (array("A","B") as $intNum) {
            if (${"integer32bit".$intNum} > static::MAX_32BIT_INTEGER_VALUE || ${"integer32bit".$intNum} < -static::MAX_32BIT_INTEGER_VALUE) {
                throw new OutOfBoundsException("Integer".$intNum." exceeds the 32bit range [0 to " .
                    static::MAX_32BIT_INTEGER_VALUE . "]: ".${"integer32bit".$intNum}." provided");
            }
        }
        $this->integer32bitA = $integer32bitA;
        $this->integer32bitB = $integer32bitB;
        $this->integer64bit = $integer32bitA<<32 | $integer32bitB;
    }

    /**
     * Unpacks a 64bit integer into 2 32 bit integers (they're really 64bit as well)
     * @param $integer64bit
     * @return IntegerPair
     */
    public static function unpack($integer64bit) {
        $integer32bitA = $integer64bit>>32 & self::MASK_32BIT;
        $integer32bitB = $integer64bit & self::MASK_32BIT;
        return new IntegerPair($integer32bitA, $integer32bitB);
    }

    /**
     * Returns the 32bit A integer   (it's really a 64bit one)
     * @return int
     */
    public function getIntegerA() {
        return $this->integer32bitA;
    }

    /**
     * Returns the 32bit B integer   (it's really a 64bit one)
     * @return int
     */
    public function getIntegerB() {
        return $this->integer32bitB;
    }

    /**
     * Returns the 64bit packed integer
     * @return int
     */
    public function get64bitInteger() {
        return $this->integer64bit;
    }

}