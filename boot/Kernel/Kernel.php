<?php

namespace Boot\Kernel;

use App\Request\Request;
use Boot\Routes\Route;

class Kernel
{
    public array $Middleware = [

    ];
    public static array $middleware = [

    ];

    public static function run()
    {
        include_once __DIR__ . "/../Helper/consts.php";

        include_once __DIR__ . "/../Helper/helper.php";

        include_once __DIR__ . "/../../Routes/web.php";
        Route::show();

        Route::Pg404();
    }


    public static final function appendMiddleware(array $Object = []): array
    {
        self::$middleware = [...$Object, ...self::$middleware];

        return self::$middleware;
    }
}