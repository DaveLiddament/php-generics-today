<?php

declare(strict_types=1);


namespace StaticAnalysis\Supporting;


class ArrayConsumer
{

    /**
     * @param int[] $ints
     */
    public static function consumeInts(array $ints): void
    {
        foreach ($ints as $int) {
            echo '' . $int;
        }
    }

    /**
     * @param string[] $strings
     */
    public static function consumeStrings(array $strings): void
    {
        echo join(",", $strings);
    }


    /**
     * @param Animal[] $animals
     */
    public static function consumeAnimals(array $animals): void
    {
        foreach ($animals as $animal) {
            $animal->feed();
        }
    }

    /**
     * @param Dog[] $dogs
     */
    public static function consumeDogs(array $dogs): void
    {
        foreach ($dogs as $dog) {
            $dog->bark();
        }
    }

}
