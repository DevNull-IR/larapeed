<?php

namespace Bootstrap\Views;

use Bootstrap\Views\Views;

/**
 * @method array view(string $path, array $data)
 */
class view
{
    public static function __callStatic($method, $args)
    {
        $instance = new Views();
        if (! $instance){
            throw new \Exception("A facade root has not been set.");
        }
        return $instance->$method(...$args);
    }
}