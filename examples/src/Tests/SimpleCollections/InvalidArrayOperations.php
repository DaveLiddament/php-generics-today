<?php

namespace StaticAnalysis\Tests\SimpleCollections;


use StaticAnalysis\Supporting\Animal;
use StaticAnalysis\Supporting\ArrayConsumer;
use StaticAnalysis\Supporting\ArrayProvider;
use StaticAnalysis\Supporting\Dog;
use StaticAnalysis\Supporting\Person;

/**
 * @return Animal[]
 */
function getAnimals(): array
{
    return [ new Person() ]; // ISSUE
}


$strings = ArrayProvider::getStrings();
$strings[] = new Person(); // ISSUE


/**
 * @return Dog[]
 */
function getDogs(): array
{
    $dogs = [];
    $dogs[] = 1;  // ISSUE
    return $dogs;
}


/** @var int[] */
$ints = [1, new Person()]; // ISSUE

ArrayConsumer::consumeInts($ints); // OK
