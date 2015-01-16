<?php

namespace IntegerPacking;

use RuntimeException;

/**
 * Class IntegerBase
 *
 * @author http://www.github.com/rmruano
 * @license https://raw.githubusercontent.com/rmruano/integer-packing/master/LICENSE
 * @package Rmruano
 */
abstract class IntegerBase {

    const MAX_32BIT_INTEGER_VALUE = 2147483647;
    const MAX_16BIT_INTEGER_VALUE = 32767;

    protected $integer64bit = 0;

    /**
     * Unpacks a 64bit integer
     * @param $integer64bit
     * @return mixed
     */
    abstract public static function unpack($integer64bit);

    /**
     * Returns the 64bit packed integer
     * @return int
     */
    public function get64bitInteger() {
        return $this->integer64bit;
    }

    /**
     * Requires that the system has 64 bit integers
     * @throws RuntimeException
     */
    protected function force64BitIntegers() {
        if (PHP_INT_SIZE < 8 || PHP_INT_MAX<=static::MAX_32BIT_INTEGER_VALUE) {
            throw new RuntimeException("Your system doesn't support 64bit integers");
        }
    }

}