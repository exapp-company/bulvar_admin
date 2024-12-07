<?php

namespace App\Interfaces;


interface HttpRequestInterface
{
    public function setOptions(array $options);
    public function execute();
    public function getInfo($name);
    public function close();
}
