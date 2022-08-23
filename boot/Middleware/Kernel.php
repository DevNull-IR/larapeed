<?php

namespace Boot\Middleware;

use Boot\Kernel\Kernel as MainKernel;

class Kernel
{
    public static function web(): array
    {
        $keys = [];
        $Kernel = new MainKernel();
        $Kernel = MainKernel::appendMiddleware();
        foreach ($Kernel as $index => $key){
            if (!is_string($key)){
                $keys[] = $index;
                unset($Kernel[$key]);
            }
        }
        return $keys;
    }
}