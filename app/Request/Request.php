<?php
namespace App\Request;


use App\Exception\RequestException;

class Request
{
    public static array $_GET = [];
    public static function all(string $key = null)
    {
        if (is_null($key)){
            return [...self::$_GET, ...$_POST];
        }
        $get = self::all();

        if (isset($get[$key])){
            return $get[$key];
        }
        return "";
    }

    public static function get(string $key = null)
    {
        if (is_null($key)){
            return self::$_GET;
        }
        $get = self::get();

        if (isset($get[$key])){
            return $get[$key];
        }
        return "";
    }

    public static function post(string $key = null)
    {
        if (is_null($key)){
            return $_POST;
        }
        $get = self::post();

        if (isset($get[$key])){
            return $get[$key];
        }
        return "";
    }
}