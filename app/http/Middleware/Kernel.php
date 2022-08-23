<?php

namespace App\http\Middleware;

class Kernel
{
    public static function web(): array
    {
        return [
//            Middleware::class
        ];
    }

    public static function Other()
    {
        return [
//            "name" => Class::class
        ];
    }
    public static function run()
    {
        \Boot\Kernel\Kernel::appendMiddleware([
            ...self::Other(),
            ...self::web()
        ]);
    }
}