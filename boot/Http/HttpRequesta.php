<?php

namespace Boot\Http;

use \Exception;

/**
 * @const GET_METHOD
 * @const POST_METHOD
 * @const PUT_METHOD
 * @const HEAD_METHOD
 * @const DELETE_METHOD
 * @method HttpRequest setHeader(array $Header)
 * @method HttpRequest setParameter(object|array $parameter)
 * @method HttpRequest setUrl(string $url)
 * @method HttpRequest setBody(object|array $body)
 * @method HttpRequest setMethod(string|int $method)
 * @method object|array getBody()
 * @method bool|string send()
 * @method array getHeader()
 * @method array getConst()
 * @method string getParameter()
 * @method string getMethod()
 * @method string getRequest()
 * @method string getUrl()
 * @method bool isBodyStat()
 * @method bool isHeaderStat()
 * @method bool isParams()
 * @method bool isSend()
 */
class HttpRequesta
{
    /**
     * @throws Exception
     */
    public static function __callStatic($method, $args)
    {
        $instance = new HttpRequest();
        return $instance->$method(...$args);
    }
}