<?php

namespace Boot\Commands;

class Commands
{
    public static function _serve(string $ip = '127.0.0.1', int $port = 8000)
    {
        return exec("php -S {$ip}:{$port} -t " . config("app.htdocs"));
    }
}