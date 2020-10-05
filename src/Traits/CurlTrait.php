<?php
// src/Traits/CurlTrait.php

namespace RestClient\Traits;

trait CurlTrait
{
    /**
     * @var false|resource
     */
    protected $curl;

    /**
     * @var string
     */
    protected $ua;

    /**
     * @param false|resource $curl
     * @param string $ua
     * @param array $settings
     * @param string $username
     * @param string $password
     */
    protected function curlInit(
        $curl,
        string $ua = '',
        array $settings = [],
        string $username = '',
        string $password = ''): void
    {
        $this->ua = $ua;

        if (is_resource($curl)) {
            $this->curl = $curl;
        }
        else {
            $this->curl = curl_init();

            curl_setopt($this->curl,CURLOPT_USERAGENT, $this->ua);

            if (!empty($settings)) {
                curl_setopt_array($this->curl, $settings);
            }
            else {
                curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
            }

            $this->curlAuth($username, $password);
        }

        libxml_use_internal_errors(true);
    }

    protected function curlAuth(string $username = '', string $password = ''): void
    {
        if (!empty($username)) {
            curl_setopt($this->curl, CURLOPT_USERPWD, $username . ':' . $password);
        }
    }
}
