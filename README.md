PHPIntegerPacks
===============

Simple convenience classes to pack multiple integers into a 64bit one and vice-versa. For simplicity, only positive
signed integers are accepted (it can be improved to support unsigned integers to provide a 2X range).

* ONLY WORKS FOR x64 BUILDS WITH 64bit INTEGERS (LINUX)*

#### IntegerPair
Allows you to pack two 32bit signed integers* into a 64bit one. A static method is provided in order to build
IntegerPair objects from packed 64bit integers.

Accepts 2 positive integers up to 2 147 483 647

(*On Linux x64 builds all integers are 64bit, by 16bits we mean integers that can be represented with 16bits)

#### IntegerQuartet
Allows you to pack four 16bit signed integers* into a 64bit one. A static method is provided in order to build
IntegerQuartet objects from packed 64bit integers.

Accepts 4 positive integers up to 32 767

(*On Linux x64 builds all integers are 64bit, by 32bits we mean integers that can be represented with 32bits)

Demo usage (IntegerPair)
------------------------
```
// Create an IntegerPair object with 2 integers (within the 32bit range)
$integerPair = new \IntegerPacking\IntegerPair(20,30);
echo "Encoded Pair | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 2 32bit integers

// Creates a new IntegerPair object from the packed 64bit integer
$otherIntegerPair = \IntegerPacking\IntegerPair::unpack( $integerPair->get64bitInteger() );
echo "Decoded Pair | A: ".$otherIntegerPair->getIntegerA()." - B: ".$otherIntegerPair->getIntegerB();
```

Demo usage (IntegerQuartet)
---------------------------
```
// Create an IntegerQuartet object with 4 integers (within the 16bit range)
$integerQuartet = new \IntegerPacking\IntegerQuartet(20,30,40,50);
echo "Encoded Quartet | ".$integerPair->get64bitInteger()."\n"; // Prints the 64 bit integer that combines the 4 16bit integers

// Creates a new IntegerQuartet object from the packed 64bit integer
$otherIntegerQuartet = \IntegerPacking\IntegerQuartet::unpack( $integerQuartet->get64bitInteger() );
echo "Decoded Quartet | A: ".$otherIntegerQuartet->getIntegerA()." - B: ".$otherIntegerQuartet->getIntegerB()." - C: ".$otherIntegerQuartet->getIntegerC()." - D: ".$otherIntegerQuartet->getIntegerD();
```