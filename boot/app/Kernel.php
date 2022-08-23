<?php

namespace Boot\app;

class Kernel
{
    public static function KernelApp(){
        \Boot\Middleware\Kernel::web();
    }
}