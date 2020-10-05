<?php
// src/Traits/Api/CreateOneTrait.php

namespace RestClient\Traits\Api;

use RestClient\Model\Status;

trait CreateOneTrait
{
    protected function createOneRequest(string $payload): Status
    {
        $this->postRequest($this->baseUrl, $payload);

        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        switch ($httpCode) {
            case 201:
                return true;
            case 400:
            case 409:
            default:
                return false;
        }
    }
}
