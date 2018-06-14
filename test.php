<?php

namespace OOP_Example;

require 'Refrigerator.php';
require 'CokeBottle.php';

$ref = new Refrigerator();

$cokes = array_fill(0, 60, new Coke());

$ref->putCan($cokes);
echo 'Stock check                 : ' . ($ref->getStockCount() === 60) . PHP_EOL;
echo 'Full check                  : ' . ($ref->isFull() === true) . PHP_EOL;

try {
    $ref->putCan(new Coke());
} catch (\Exception $e) {
    echo 'Space check                 : ' . ($e->getMessage() === 'There is no space available!') . PHP_EOL;
}


$result = $ref->getCan(3);

echo 'Stock check                 : ' . ($ref->getStockCount() === 57) . PHP_EOL;
echo 'Full check                  : ' . ($ref->isFull() === false) . PHP_EOL;
echo 'Result check                : ' . ((count($result)) === 3) . PHP_EOL;

$result = $ref->getCan(57);

echo 'Stock check                 : ' . ($ref->getStockCount() === 0) . PHP_EOL;
echo 'Full check                  : ' . ($ref->isFull() === false) . PHP_EOL;
echo 'Result check                : ' . ((count($result)) === 57) . PHP_EOL;

$result = $ref->getCan(1);

echo 'Stock check                 : ' . ($ref->getStockCount() === 0) . PHP_EOL;
echo 'Result check                : ' . ((count($result)) === 0) . PHP_EOL;

// Re-Full
$ref->putCan($cokes);
$result = $ref->getCan(57);

// receive : 10 -> result : 3
$result = $ref->getCan(10);

echo 'Stock check                 : ' . ($ref->getStockCount() === 0) . PHP_EOL;
echo 'Result check                : ' . ((count($result)) === 3) . PHP_EOL;

$ref = new Refrigerator();

try {
    $ref->putCan(new CokeBottle());
} catch (\Exception $e) {
    echo 'allow only one product type : ' . ($e->getMessage() === 'Please put a can!') . PHP_EOL;
}
