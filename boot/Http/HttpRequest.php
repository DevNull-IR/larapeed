<?php

namespace Boot\Http;

use App\Exception\RequestException;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class HttpRequestClass
{
    public const GET_METHOD = 1;
    public const POST_METHOD = 2;
    public const PUT_METHOD = 3;
    public const HEAD_METHOD = 4;
    public const DELETE_METHOD = 5;

    private string $request = "curl";
    private string $url;
    private string $method = "get";
    private bool $send = false;
    private array|object $parameter = [];
    private bool $params = false;
    private bool $bodyStat = false;
    private array|object $body = [];
    private bool $headerStat = false;
    private array $Header = [];

    #[Pure] public function __construct()
    {
        if (!$this->_isCurl()){
            $this->request = "httpRequest";
        }
    }

    /**
     * @return bool
     */
    protected function _isCurl(): bool
    {
        return function_exists('curl_version');
    }

    /**
     * @param array $Header
     * @return HttpRequestClass
     */
    public function setHeader(array $Header): HttpRequestClass
    {
        $this->Header = $Header;
        $this->headerStat = true;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->Header;
    }

    /**
     * @param array|object $parameter
     * @return HttpRequestClass
     */
    public function setParameter(object|array $parameter): HttpRequestClass
    {
        $this->parameter = array_merge($this->parameter, $parameter);
        $this->params = true;
        return $this;
    }

    /**
     * @return array
     */
    #[ArrayShape(["get" => "int", "post" => "int", "head" => "int", "delete" => "int", "put" => "int"])] public function getConst(): array
    {
        return [
            "get" => self::GET_METHOD,
            "post" => self::POST_METHOD,
            "head" => self::HEAD_METHOD,
            "delete" => self::DELETE_METHOD,
            "put" => self::PUT_METHOD
        ];
    }

    /**
     * @return string
     */
    public function getParameter(): string
    {
        return http_build_query($this->parameter);
    }

    /**
     * @param string $url
     * @return HttpRequestClass
     * @throws RequestException
     */
    public function setUrl(string $url): HttpRequestClass
    {
        if (filter_var($url, 273)){
            $this->url = $url;
            $this->send = true;
            return $this;
        }
        throw new RequestException("parameter is required url");
    }

    /**
     * @return bool
     */
    public function isBodyStat(): bool
    {
        return $this->bodyStat;
    }

    /**
     * @return bool
     */
    public function isHeaderStat(): bool
    {
        return $this->headerStat;
    }

    /**
     * @return bool
     */
    public function isParams(): bool
    {
        return $this->params;
    }

    /**
     * @return bool
     */
    public function isSend(): bool
    {
        return $this->send;
    }

    /**
     * @param array|object $body
     * @return HttpRequestClass
     */
    public function setBody(object|array $body): HttpRequestClass
    {
        $this->body = $body;
        $this->bodyStat = true;
        return $this;
    }

    /**
     * @return array|object
     */
    public function getBody(): object|array
    {
        return $this->body;
    }

    /**
     * @param string|int $method
     * @return HttpRequestClass
     * @throws RequestException
     */
    public function setMethod(string|int $method): HttpRequestClass
    {
        if (is_numeric($method)){
            if ($method <= 5 && $method >= 1){
                $method = str_replace(
                    [
                        1,
                        2,
                        3,
                        4,
                        5
                    ],
                [
                    "get",
                    "post",
                    "put",
                    "head",
                    "delete"
                ],
                $method);
                $this->method = $method;
                return $this;
            }
            throw new RequestException("Enter a number between 1 and 5");
        }
        $method = strtolower($method);
        if ($method == "get" or $method == "post" or $method == "put" or $method == "delete" or $method == "head"){
            $this->method = $method;
            return $this;
        }
        throw new RequestException("Enter Method for (post, put, delete, get, head)");
    }

    /**
     * @return string
     * @throws RequestException
     */
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @return string
     * @throws RequestException
     */
    public function getUrl(): string
    {
        if ($this->send){
            $param = "";
            if ($this->params){
                if (mb_substr($this->url, -2) == "/?"){
                    $param = $this->getParameter();
                }else{
                    $param = "/?" . $this->getParameter();
                }
            }
            return $this->url . $param;
        }
        throw new RequestException("url not found; pleas enter url");
    }

    /**
     * @return bool|string
     * @throws RequestException
     */
    public function send(): bool|string
    {
        if ($this->send){
            if ($this->request == "curl"){
                $curl = curl_init();
                curl_setopt($curl, 10002, $this->getUrl()); // set Url
                curl_setopt($curl, 19913, true); // CURLOPT_RETURNTRANSFER
                curl_setopt($curl, 10102, ''); // CURLOPT_ENCODING
                curl_setopt($curl, 68, 10); // CURLOPT_MAXREDIRS
                curl_setopt($curl, 13, 0); // CURLOPT_TIMEOUT
                curl_setopt($curl, 52, true); // CURLOPT_FOLLOWLOCATION
                curl_setopt($curl, 84, 2); // CURLOPT_HTTP_VERSION // CURL_HTTP_VERSION_1_1
                curl_setopt($curl, 10036, strtoupper($this->method)); // CURLOPT_HTTP_VERSION // CURL_HTTP_VERSION_1_1
                if ($this->bodyStat){
                    curl_setopt($curl, 10015, json_encode($this->body, 448)); // CURLOPT_HTTP_VERSION // CURL_HTTP_VERSION_1_1
                }
                if ($this->headerStat){
                    curl_setopt($curl, 10023, $this->getHeader());
                }
                $response = curl_exec($curl);

                curl_close($curl);

                return $response;
            }
        }
        throw new RequestException("url not found; pleas enter url");
    }
}