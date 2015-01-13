<?php

require("./vendor/autoload.php");

Header("Content-type: text/plain");

// INTEGER PAIR ------------------------------------------------
    // Create an IntegerPair object with 2 integers (within the 32bit range)
    $integerPair = new \IntegerPacking\IntegerPair(20,30);
    echo "Encoded Pair | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 2 32bit integers
    // Creates a new IntegerPair object from the packed 64bit integer
    $otherIntegerPair = \IntegerPacking\IntegerPair::unpack( $integerPair->get64bitInteger() );
    echo "Decoded Pair | A: ".$otherIntegerPair->getIntegerA()." - B: ".$otherIntegerPair->getIntegerB();

// INTEGER QUARTET ------------------------------------------------
    // Create an IntegerQuartet object with 4 integers (within the 16bit range)
    $integerQuartet = new \IntegerPacking\IntegerQuartet(20,30,40,50);
    echo "Encoded Quartet | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 4 16bit integers
    // Creates a new IntegerQuartet object from the packed 64bit integer
    $otherIntegerQuartet = \IntegerPacking\IntegerQuartet::unpack( $integerQuartet->get64bitInteger() );
    echo "Decoded Quartet | A: ".$otherIntegerQuartet->getIntegerA()." - B: ".$otherIntegerQuartet->getIntegerB()." - C: ".$otherIntegerQuartet->getIntegerC()." - D: ".$otherIntegerQuartet->getIntegerD();