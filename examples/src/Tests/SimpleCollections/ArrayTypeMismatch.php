<?php

namespace StaticAnalysis\Tests\SimpleCollections;


use StaticAnalysis\Supporting\ArrayConsumer;
use StaticAnalysis\Supporting\ArrayProvider;

$arrayOfStrings = ArrayProvider::getStrings();

ArrayConsumer::consumeInts($arrayOfStrings); // ISSUE
