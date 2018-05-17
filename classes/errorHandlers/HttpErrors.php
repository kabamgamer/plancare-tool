<?php

namespace errorHandlers;


class HttpErrors
{
    private $_passed,
            $_http;

    public function __construct($http)
    {
        $this->_http = $http;
        $httpStatus = substr($http, 9, 1);

        switch ($httpStatus) {
            case "2" :
                $this->_passed = true;
            break;
            case "4" :
                $this->_passed = false;
            break;
            case "5" :
                $this->_passed = false;
            break;
        }
    }

    public function error()
    {

    }

    public function passed()
    {
        return $this->_passed;
    }
}