<?php
// src/Curl/Handler.php

namespace RestClient\Curl;

use RestClient\Exception\CurlException;

class Handler extends AbstractHandler
{
    /**
     * Handler constructor
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
        parent::__construct($curl, $ua, $settings, $username, $password);
    }

    /**
     * Handler destructor
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @param string $url
     * @return string
     * @throws CurlException
     */
    public function getRequest(string $url): string
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);

        return $this->result(curl_exec($this->curl));
    }

    /**
     * @param string $url
     * @param string $payload
     * @return string
     * @throws CurlException
     */
    public function postRequest(string $url, string $payload): string
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $payload);

        return $this->result(curl_exec($this->curl));
    }

    /**
     * @param bool|string $result
     * @return string
     * @throws CurlException
     */
    private function result($result): string
    {
        if (curl_errno($this->curl)) {
            throw new CurlException(curl_error($this->curl));
        }

        if (is_bool($result)) {
            return '';
        }

        return $result;
    }
}
