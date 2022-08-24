<?php

namespace Boot\Http;

use \Exception;

/**
 * @const GET_METHOD
 * @const POST_METHOD
 * @const PUT_METHOD
 * @const HEAD_METHOD
 * @const DELETE_METHOD
 * @method HttpRequestClass setHeader(array $Header)
 * @method HttpRequestClass setParameter(object|array $parameter)
 * @method HttpRequestClass setUrl(string $url)
 * @method HttpRequestClass setBody(object|array $body)
 * @method HttpRequestClass setMethod(string|int $method)
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
class HttpRequest
{
    /**
     * @throws Exception
     */
    public static function __callStatic($method, $args)
    {
        $instance = new HttpRequestClass();
        return $instance->$method(...$args);
    }
}