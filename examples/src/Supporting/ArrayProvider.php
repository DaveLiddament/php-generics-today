<?php

declare(strict_types=1);


namespace StaticAnalysis\Supporting;


class ArrayProvider
{

    /**
     * @return int[]
     */
    public static function getInts(): array
    {
        return [1];
    }

    /**
     * @return string[]
     */
    public static function getStrings(): array
    {
        return ["foo"];
    }

    /**
     * @return Animal[]
     */
    public static function getAnimals(): array
    {
        return [new Animal()];
    }

    /**
     * @return Dog[]
     */
    public static function getDogs(): array
    {
        return [new Dog];
    }
}

