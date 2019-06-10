<?php

namespace StaticAnalysis\Tests\SimpleCollections;


use StaticAnalysis\Supporting\IterableConsumer;
use StaticAnalysis\Supporting\IterableProvider;

$iterableOfStrings = IterableProvider::getStrings(); // OK

IterableConsumer::consumeInts($iterableOfStrings); // ISSUE
