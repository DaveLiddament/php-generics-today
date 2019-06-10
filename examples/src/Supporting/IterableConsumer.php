<?php

declare(strict_types=1);


namespace StaticAnalysis\Supporting;


class IterableConsumer
{

    /**
     * @param int[] $ints
     */
    public static function consumeInts(iterable $ints): void
    {
        foreach ($ints as $int) {
            echo '' . $int;
        }
    }

    /**
     * @param string[] $strings
     */
    public static function consumeStrings(iterable $strings): void
    {
        echo join(",", $strings);
    }


    /**
     * @param Animal[] $animals
     */
    public static function consumeAnimals(iterable $animals): void
    {
        foreach ($animals as $animal) {
            $animal->feed();
        }
    }

}
