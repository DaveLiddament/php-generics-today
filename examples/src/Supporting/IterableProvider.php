<?php

declare(strict_types=1);


namespace StaticAnalysis\Supporting;


class IterableProvider
{

    /**
     * @return int[]
     */
    public static function getInts(): iterable
    {
        return [1];
    }

    /**
     * @return string[]
     */
    public static function getStrings(): iterable
    {
        return ["foo"];
    }

    /**
     * @return Animal[]
     */
    public static function getAninamls(): iterable
    {
        return [new Animal()];
    }
}

