<?php

namespace StaticAnalysis\Tests\SimpleCollections;


use StaticAnalysis\Supporting\ArrayConsumer;
use StaticAnalysis\Supporting\ArrayProvider;
use StaticAnalysis\Supporting\IterableConsumer;

$arrayOfAnimals = ArrayProvider::getAnimals();
ArrayConsumer::consumeDogs($arrayOfAnimals); // ISSUE

$arrayOfDogs = ArrayProvider::getDogs();
ArrayConsumer::consumeAnimals($arrayOfDogs); // OK


