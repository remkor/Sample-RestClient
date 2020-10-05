<?php
// src/Connection/AbstractProducersConnector.php

namespace RestClient\Connection;

use Psr\Http\Message\UriInterface;
use RestClient\Curl\Handler;
use RestClient\Interfaces\Api\CreateOneInterface;
use RestClient\Interfaces\Api\GetAllInterface;
use RestClient\Interfaces\EntityInterface;
use RestClient\Model\Psr7\Uri;

abstract class AbstractProducersConnector extends Handler implements CreateOneInterface, GetAllInterface
{
    /**
     * @var UriInterface
     */
    protected $baseUrl;

    /**
     * AbstractProducersConnector constructor
     *
     * @param string|UriInterface $baseUrl
     * @param false|resource $curl
     * @param string $ua
     * @param array $settings
     * @param string $username
     * @param string $password
     */
    public function __construct(
        $baseUrl,
        $curl,
        string $ua = '',
        array $settings = [],
        string $username = '',
        string $password = '')
    {
        if (is_string($baseUrl)) {
            $baseUrl = Uri::initWithString($baseUrl);
        }

        $this->baseUrl = $baseUrl;

        parent::__construct($curl, $ua, $settings, $username, $password);
    }

    abstract public function createOne(EntityInterface $producer): bool;

    abstract public function getAll(): array;
}
