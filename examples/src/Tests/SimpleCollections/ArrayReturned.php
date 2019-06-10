<?php

namespace StaticAnalysis\Tests\SimpleCollections;


use StaticAnalysis\Supporting\ArrayConsumer;
use StaticAnalysis\Supporting\ArrayProvider;
use StaticAnalysis\Supporting\IterableConsumer;

$arrayOfStrings = ArrayProvider::getStrings();

ArrayConsumer::consumeStrings($arrayOfStrings); // OK

IterableConsumer::consumeStrings($arrayOfStrings); // OK

ArrayConsumer::consumeInts($arrayOfStrings); // ISSUE

