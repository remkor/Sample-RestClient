<?php
// src/Interfaces/RestInterface.php

namespace RestClient\Interfaces;

interface RestInterface
{
    /**
     * @param string $url
     * @return mixed
     */
    function getRequest(string $url);

    /**
     * @param string $url
     * @param string $payload
     * @return mixed
     */
    function postRequest(string $url, string $payload);
}
