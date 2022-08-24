<?php

use Boot\Http\HttpRequest as HttpRequest;
use Boot\Routes\Route as Routes;






Routes::get("/", function (){
    $new = new HttpRequest();
    $new->setUrl("https://f1r.ir");
    $new->setMethod(POST_METHOD);
    $new->setParameter([
        "is" => "str",
        "sdfsdfdfg" => "Sdfsdf"
    ]);
    echo $new->getUrl();
    $new->setBody([
        "is" => "nois"
    ]);
    var_dump($new->send());
//    HttpRequest::setUrl("https://f1r.ir");
//    HttpRequest::setMethod(GET_METHOD);
//    var_dump(HttpRequest::send());
});
Routes::get("/api", __DIR__ . "/api.php");

Routes::post("/api", __DIR__ . "/api.php");

