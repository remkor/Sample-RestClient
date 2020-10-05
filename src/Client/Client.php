<?php
// src/Client/Client.php

namespace RestClient\Client;

use Psr\Http\Message\UriInterface;
use RestClient\Connection\ProducersConnector;
use RestClient\Model\Psr7\Uri;
use RestClient\Traits\CurlTrait;

class Client
{
    use CurlTrait;

    /**
     * @var UriInterface
     */
    protected $baseUrl;

    /**
     * @var ProducersConnector
     */
    public $producers;

    /**
     * Client constructor
     *
     * @param string|UriInterface $baseUrl
     * @param string $ua
     */
    public function __construct($baseUrl, string $ua)
    {
        if (is_string($baseUrl)) {
            $baseUrl = Uri::initWithString($baseUrl);
        }

        $this->baseUrl = $baseUrl;

        $this->curlInit(false, $ua, []);
    }

    /**
     * Client destructor
     */
    public function __destruct()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }
    }

    public function addProducersConnector(): void
    {
        $baseUrl = $this->baseUrl->withPath('/shop_api/v1/producers');

        $this->producers = new ProducersConnector($baseUrl, $this->curl);
    }
}
