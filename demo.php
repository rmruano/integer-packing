<?php

Header("Content-type: text/plain");

include("./lib/Rmruano/IntegerPair.php");

// Create an IntegerPair object with 2 integers (within the 32bit range)
$integerPair = new \Rmruano\IntegerPair(20,30);
echo "Encoded Pair | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 2 32bit integers

// Creates a new IntegerPair object from the packed 64bit integer
$otherIntegerPair = \Rmruano\IntegerPair::unpack( $integerPair->get64bitInteger() );
echo "Decoded Pair | A: ".$integerPair->getIntegerA()." - B: ".$integerPair->getIntegerB();