<?php

namespace App\Services;

use App\Interfaces\HttpRequestInterface;

class CurlRequestService implements HttpRequestInterface
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function setOptions(array $options) {
        curl_setopt_array($this->curl, $options);
    }


    public function execute() {
        return curl_exec($this->curl);
    }

    public function getInfo($name) {
        return curl_getinfo($this->curl, $name);
    }

    public function close() {
        curl_close($this->curl);
    }

}
