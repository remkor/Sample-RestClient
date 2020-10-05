<?php
// src/Curl/AbstractConnector.php

namespace RestClient\Curl;

use RestClient\Interfaces\RestInterface;
use RestClient\Traits\CurlTrait;

abstract class AbstractHandler implements RestInterface
{
    use CurlTrait;

    /**
     * AbstractHandler constructor
     *
     * @param false|resource $curl
     * @param string $ua
     * @param array $settings
     * @param string $username
     * @param string $password
     */
    public function __construct(
        $curl,
        string $ua = '',
        array $settings = [],
        string $username = '',
        string $password = '')
    {
        if (is_resource($curl)) {
            $this->curl = $curl;
        }
        else {
            $this->curlInit(false, $ua, $settings, $username, $password);
        }
    }

    /**
     * AbstractHandler destructor
     */
    public function __destruct()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }
    }

    /**
     * @param string $url
     * @return mixed
     */
    abstract public function getRequest(string $url);

    /**
     * @param string $url
     * @param string $payload
     * @return mixed
     */
    abstract public function postRequest(string $url, string $payload);
}
