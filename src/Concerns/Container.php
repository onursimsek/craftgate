<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Concerns;

class Container
{
    private static array $container = [];

    public static function pushOrGet(string $class, ...$args): object
    {
        if (array_key_exists($class, self::$container)) {
            return self::$container[$class];
        }

        return self::$container[$class] = new $class(...$args);
    }
}
