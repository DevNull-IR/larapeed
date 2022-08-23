<?php

use \Bootstrap\Settings;
use \App\Request\Request;
use \Bootstrap\Views\view;



if (! function_exists("config")){
    function config(String $Info){
        return Settings::config($Info);
    }
}

if (! function_exists("public_path")){
    function public_path(string $filePath = ""){
        return Settings::public_path($filePath);
    }
}
if (! function_exists("config_path")){
    function  config_path(string $filePath = ""): string{
        return Settings::config_path($filePath);
    }
}

if (! function_exists("all")){
    function all(string $key = null){
        return Request::all($key);
    }
}

if (! function_exists("get")){
    function get(string $key = null){
        return Request::get($key);
    }
}

if (! function_exists("post")){
    function post(string $key = null){
        return Request::post($key);
    }
}
if (! function_exists("view")){
    function view(string $path, array $data): array{
        return view::view($path, $data);
    }
}