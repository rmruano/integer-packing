PHPIntegerPair
==============

Allows you to pack two 32bit signed integers* into a 64bit one. A static method is provided in order to build
IntegerPair objects from packed 64bit integers.

(*On x64 builds all integers are 64bit, by 32 bits we mean integers that can be represented with 32bits)

##### ONLY WORKS FOR x64 BUILDS

Demo usage
----------
```
// Create an IntegerPair object with 2 integers (within the 32bit range)
$integerPair = new \Rmruano\IntegerPair(20,30);
echo "Encoded Pair | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 2 32bit integers

// Creates a new IntegerPair object from the packed 64bit integer
$otherIntegerPair = \Rmruano\IntegerPair::unpack( $integerPair->get64bitInteger() );
echo "Decoded Pair | A: ".$otherIntegerPair->getIntegerA()." - B: ".$otherIntegerPair->getIntegerB();
```