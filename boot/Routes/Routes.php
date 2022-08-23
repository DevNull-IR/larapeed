<?php

namespace Boot\Routes;


use App\Exception\RouteException;
use App\Request\Request;

class Routes {
    protected array $Uri = [];
    protected bool $status = true;
    protected function index()
    {

    }
    public function get(string $uri, $file)
    {
        if (gettype($file) == "array"){
            $this->Uri[] = [

                "uri" => $uri,
                "method" => "get",
                "file" => $file,
                "type" => "array"

            ];
        }else{
            $this->Uri[] = [

                "uri" => $uri,
                "method" => "get",
                "file" => $file,
                "type" => "callback"

            ];
        }

//        if ($_SERVER['REQUEST_METHOD'] == "GET") {
//            echo $uri;
//            if ($uri == "/"){
//                if (!isset($_SERVER['PATH_INFO'])){
//                    require_once $file;
//                    die();
//                }
//            }
//            if (isset($_SERVER['PATH_INFO']) or !empty($_SERVER['PATH_INFO'])){
//                if ($_SERVER['PATH_INFO'] == $uri) {
//                    require_once $file;
//                    die();
//                }
//            }
//            throw new RouteException("this is url not found");
//        }
    }
    public function post(string $uri, string $file)
    {
        $this->Uri[] = [
            "uri" => $uri,
            "method" => "post",
            "file" => $file
        ];
//        return false;
//        if ($_SERVER['REQUEST_METHOD'] == "POST"){
//            if (empty(Request::post("_method")) or strtolower(Request::post("_method")) == "_post") {
//                if ($uri == "/"){
//                    if (!isset($_SERVER['PATH_INFO']) or empty($_SERVER['PATH_INFO'])){
//                        require_once $file;
//                        return true;
//                    }
//                }
//                if (isset($_SERVER['PATH_INFO']) or !empty($_SERVER['PATH_INFO'])){
//                    if ($_SERVER['PATH_INFO'] == $uri) {
//                        require_once $file;
//                        return true;
//                    }
//                }
//            }
//            throw new RouteException("this is url not found");
//        }
    }
    public function delete(string $uri, string $file)
    {

        $this->Uri[] = [
            "uri" => $uri,
            "method" => "delete",
            "file" => $file
        ];
//        return false;
//        if ($_SERVER['REQUEST_METHOD'] == "POST"){
//            if (!is_null(Request::post("_method")) or strtolower(Request::post("_method")) == "_delete") {
//                if ($uri == "/"){
//                    if (!isset($_SERVER['PATH_INFO']) or empty($_SERVER['PATH_INFO'])){
//                        require_once $file;
//                        return true;
//                    }
//                }
//                if (isset($_SERVER['PATH_INFO']) or !empty($_SERVER['PATH_INFO'])){
//                    if ($_SERVER['PATH_INFO'] == $uri) {
//                        require_once $file;
//                        return true;
//                    }
//                }
//            }
//            throw new RouteException("this is url not found");
//
//        }
    }
    public function put(string $uri, string $file)
    {

        $this->Uri[] = [
            "uri" => $uri,
            "method" => "put",
            "file" => $file
        ];
//        return false;
//        if ($_SERVER['REQUEST_METHOD'] == "POST"){
//            if (!is_null(Request::post("_method")) or strtolower(Request::post("_method")) == "_put") {
//                if ($uri == "/"){
//                    if (!isset($_SERVER['PATH_INFO']) or empty($_SERVER['PATH_INFO'])){
//                        require_once $file;
//                        return true;
//                    }
//                }
//                if (isset($_SERVER['PATH_INFO']) or !empty($_SERVER['PATH_INFO'])){
//                    if ($_SERVER['PATH_INFO'] == $uri) {
//                        require_once $file;
//                        return true;
//                    }
//                }
//            }
//            throw new RouteException("this is url not found");
//        }
    }

    public function show()
    {

    }
    public function __destruct()
    {
        foreach ($this->Uri as $arrays){
            if ($arrays['uri'] == "/" && !isset($_SERVER['PATH_INFO'])){
                if (strtolower($_SERVER['REQUEST_METHOD']) == $arrays['method']){
                    if ($arrays['type'] == "callback"){

                        $data = $arrays['file']();
                        if (gettype($data) != "array" or gettype($data) != "object"){

                            die($data);
                        }
                        extract($data[1]);
                        $getFile = file_get_contents($data[0]);
                        $getFile =  str_replace(["{{", "}}", "{!!", "!!}"], ["<?= htmlspecialchars(", "); ?>", "<?=", "?>"], $getFile);
                        $filePath = __DIR__ . "/../../storage/app/view/" . rand(11111, 99999) . ".php";
                        file_put_contents($filePath, $getFile);
                        require $filePath;
                        unlink($filePath);
                        $this->status = false;

                        die();
                    }
                }
            }
            if (!isset($_SERVER['PATH_INFO'])) {
                throw new RouteException("path_info is Not found");
            }

            if ($_SERVER['PATH_INFO'] == $arrays['uri']){
                if (strtolower($_SERVER['REQUEST_METHOD']) == $arrays['method']){
                    require $arrays['file'];
                    $this->status = false;
                    die();
                }
            }
        }
    }

    public function Pg404()
    {
        require __DIR__ . "/../../resources/errors/404.peed.php";
    }
}