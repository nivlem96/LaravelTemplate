<?php

namespace App\Helpers;

class ClassHelper
{
    public static function getClassName(object $class): string
    {
        $classString = get_class($class);
        $explodedClassName = explode('\\', $classString);

        return $explodedClassName[count($explodedClassName) - 1];
    }

    public static function classHasTrait(object $class, string $trait): bool
    {
        return in_array(
            $trait,
            array_keys((new \ReflectionClass($class::class))->getTraits())
        );
    }
}
