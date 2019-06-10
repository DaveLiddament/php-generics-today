<?php

namespace StaticAnalysis\Tests\SimpleCollections;


use StaticAnalysis\Supporting\ArrayConsumer;
use StaticAnalysis\Supporting\IterableConsumer;
use StaticAnalysis\Supporting\IterableProvider;

$iterableOfStrings = IterableProvider::getStrings();

IterableConsumer::consumeStrings($iterableOfStrings); // OK

ArrayConsumer::consumeStrings($iterableOfStrings); // ISSUE




