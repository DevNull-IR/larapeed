<?php

use Boot\Routes\Route as Routes;

Routes::get("/", function (){


    return view("abc", [
        "a" => "<a>Ok</a>"
    ]);



});


Routes::get("/api", __DIR__ . "/api.php");

Routes::post("/api", __DIR__ . "/api.php");

