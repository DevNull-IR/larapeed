<?php

use Boot\Routes\Route as Routes;

Routes::get("/", function (){
    $new = new \Boot\Http\HttpRequestClass();

    $new->setMethod(GET_METHOD);
    $new->getConst();

    return view("abc", [
        "a" => "<a>Ok</a>"
    ]);



});


Routes::get("/api", __DIR__ . "/api.php");

Routes::post("/api", __DIR__ . "/api.php");

