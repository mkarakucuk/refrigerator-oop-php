<?php

namespace OOP_Example;

if (!defined('DEBUG')) {
    define('DEBUG', false);
}

require 'Refrigerator.php';
require 'CokeBottle.php';

$ref = new Refrigerator();

$cokes = array_fill(0, 60, new Coke33());

$ref->putCan($cokes);
echo 'Stock check                 : ' . json_encode($ref->getStockCount() === 60) . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === true) . PHP_EOL;

try {
    $ref->putCan(new Coke33());
} catch (\Exception $e) {
    echo 'Space check                 : ' . json_encode($e->getMessage() === 'There is no space available!') . PHP_EOL;
}


$result = $ref->getCan(3);

echo 'Stock check                 : ' . json_encode($ref->getStockCount() === 57) . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === false) . PHP_EOL;
echo 'Result check                : ' . json_encode((count($result)) === 3) . PHP_EOL;

$result = $ref->getCan(57);

echo 'Stock check                 : ' . json_encode($ref->getStockCount() === 0) . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === false) . PHP_EOL;
echo 'Result check                : ' . json_encode((count($result)) === 57) . PHP_EOL;

$result = $ref->getCan(1);

echo 'Stock check                 : ' . json_encode($ref->getStockCount() === 0) . PHP_EOL;
echo 'Result check                : ' . json_encode((count($result)) === 0) . PHP_EOL;

// Re-Full
$ref->putCan($cokes);
$result = $ref->getCan(57);

// receive : 10 -> result : 3
$result = $ref->getCan(10);

echo 'Stock check                 : ' . json_encode($ref->getStockCount() === 0) . PHP_EOL;
echo 'Result check                : ' . json_encode((count($result)) === 3) . PHP_EOL;

$ref = new Refrigerator();

try {
    $ref->putCan(new CokeBottle());
} catch (\Exception $e) {
    echo 'allow only one product type : ' . json_encode($e->getMessage() === 'Please put a can!') . PHP_EOL;
}

echo '-------------------------------------' . PHP_EOL;

$ref = new Refrigerator();

$cokes33 = array_fill(0, 30, new Coke33());
$cokes50 = array_fill(0, 15, new Coke50());


$ref->putCan($cokes33);
echo 'Add 33cl x 30               : ' . json_encode($ref->getStockCount() === 30) . ' (' . $ref->getStockCount() . ')' . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === false) . PHP_EOL;
$ref->putCan($cokes50);
echo 'Add 50cl x 15               : ' . json_encode($ref->getStockCount() === 45) . ' (' . $ref->getStockCount() . ')' . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === true) . PHP_EOL;

echo '-------------------------------------' . PHP_EOL;

$ref = new Refrigerator();

$cokes33 = array_fill(0, 29, new Coke33());
$cokes50 = array_fill(0, 15, new Coke50());


$ref->putCan($cokes33);
echo 'Add 33cl x 29               : ' . json_encode($ref->getStockCount() === 29) . ' (' . $ref->getStockCount() . ')' . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === false) . PHP_EOL;
$ref->putCan($cokes50);
echo 'Add 50cl x 15               : ' . json_encode($ref->getStockCount() === 44) . ' (' . $ref->getStockCount() . ')' . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === false) . PHP_EOL;


try {
    $ref->putCan(new Coke50());
} catch (\Exception $e) {
    echo 'Couldnt add 50cl (no space) : ' . json_encode($e->getMessage() === 'There is no space available!') . PHP_EOL;
}

$ref->putCan(new Coke33());
echo 'Add 33cl x 1                : ' . json_encode($ref->getStockCount() === 45) . ' (' . $ref->getStockCount() . ')' . PHP_EOL;
echo 'Full check                  : ' . json_encode($ref->isFull() === true) . PHP_EOL;
