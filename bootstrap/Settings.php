<?php

namespace Bootstrap;

class Settings
{
    public static function config(String $Info)
    {
        $exp = explode(".", $Info);
        if (count($exp) == 1){
            if (file_exists(__DIR__ . "/../config/{$Info}.php")){
                return require __DIR__ . "/../config/{$Info}.php";
            }else{
                return "Not Found";
            }
        }
        return config($exp[0])[ $exp[1] ];
    }

    public static function public_path(string $filePath = ""): string
    {
        $path = explode( "\\", __DIR__);
        $pathCode = array_search("bootstrap", $path);
        unset($path[$pathCode]);
        if ($filePath != ""){
            $filePath = "\\" . $filePath;
        }
        return implode("\\", $path) . "\\" . config("app.htdocs") . $filePath;
    }

    public static function config_path(string $filePath = ""): string
    {
        $path = explode( "\\", __DIR__);
        $pathCode = array_search("bootstrap", $path);
        unset($path[$pathCode]);
        if ($filePath != ""){
            $filePath = "\\" . $filePath;
        }
        return implode("\\", $path) . "\\config"  . $filePath;
    }

    public static function resources_path(string $filePath = ""): string
    {
        $path = explode( "\\", __DIR__);
        $pathCode = array_search("bootstrap", $path);
        unset($path[$pathCode]);
        if ($filePath != ""){
            $filePath = "\\" . $filePath;
        }
        return implode("\\", $path) . "\\resources"  . $filePath;
    }

    public static function views_path(string $filePath = ""): string
    {
        $path = explode( "\\", __DIR__);
        $pathCode = array_search("bootstrap", $path);
        unset($path[$pathCode]);
        if ($filePath != ""){
            $filePath = "\\" . $filePath;
        }
        return implode("\\", $path) . "\\resources\\views"  . $filePath;
    }
}