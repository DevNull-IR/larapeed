<?php

namespace App\Exception;


use \Exception;

class RouteException extends Exception
{
    public function errorMessage()
    {
        $errorMsg = 'Error on line ' . $this->getLine() . ': <b>' . $this->getMessage() . '</b>';
        return $errorMsg;
    }
}