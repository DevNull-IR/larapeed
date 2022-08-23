<?php

namespace Boot\Routes;

/**
 * @method get(string $uri, string $file)
 * @method post(string $uri, string $file)
 * @method delete(string $uri, string $file)
 * @method put(string $uri, string $file)
 * @method show()
 */
class Route
{
    public static function __callStatic($method, $args)
    {
        $instance = new Routes();
        if (! $instance){
            throw new \Exception("A facade root has not been set.");
        }
        return $instance->$method(...$args);
    }
}