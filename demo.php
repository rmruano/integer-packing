<?php

Header("Content-type: text/plain");

// INTEGER PAIR ------------------------------------------------
    include("./lib/Rmruano/IntegerPair.php");
    // Create an IntegerPair object with 2 integers (within the 32bit range)
    $integerPair = new \Rmruano\IntegerPair(20,30);
    echo "Encoded Pair | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 2 32bit integers
    // Creates a new IntegerPair object from the packed 64bit integer
    $otherIntegerPair = \Rmruano\IntegerPair::unpack( $integerPair->get64bitInteger() );
    echo "Decoded Pair | A: ".$otherIntegerPair->getIntegerA()." - B: ".$otherIntegerPair->getIntegerB();

// INTEGER QUARTET ------------------------------------------------
    include("./lib/Rmruano/IntegerQuartet.php");
    // Create an IntegerQuartet object with 4 integers (within the 16bit range)
    $integerQuartet = new \Rmruano\IntegerQuartet(20,30,40,50);
    echo "Encoded Quartet | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 4 16bit integers
    // Creates a new IntegerQuartet object from the packed 64bit integer
    $otherIntegerQuartet = \Rmruano\IntegerQuartet::unpack( $integerQuartet->get64bitInteger() );
    echo "Decoded Quartet | A: ".$otherIntegerQuartet->getIntegerA()." - B: ".$otherIntegerQuartet->getIntegerB()." - C: ".$otherIntegerQuartet->getIntegerC()." - D: ".$otherIntegerQuartet->getIntegerD();