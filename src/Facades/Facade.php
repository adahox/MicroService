<?php

namespace App\Facades;

abstract class Facade
{
    /**
     * @param string $methodName
     * @param array $arguments
     */
    public static function __callStatic(
        string $methodName,
        array $arguments,
    ): mixed {
        # Busco a instancia do $methodName
        $instance = static::getFacadeRoot();

        if (!$instance) {
            throw new \Error(
                "Não foi possível incontrar a instancia do " . static::class,
            );
        }

        return $instance->{$methodName}(...$arguments);
    }

    abstract public static function getFacadeRoot(): mixed;
}
