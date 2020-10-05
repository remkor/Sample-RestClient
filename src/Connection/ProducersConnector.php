<?php
// src/Connection/ProducersConnector;

namespace RestClient\Connection;

use RestClient\Entity\Producer;
use RestClient\Exception\CurlException;
use RestClient\Interfaces\EntityInterface;

class ProducersConnector extends AbstractProducersConnector
{
    /**
     * ProducersConnector constructor
     *
     * @param string $baseUrl
     * @param false|resource $curl
     * @param string $ua
     * @param array $settings
     * @param string $username
     * @param string $password
     */
    public function __construct(
        string $baseUrl,
        $curl,
        string $ua = '',
        array $settings = [],
        string $username = '',
        string $password = '')
    {
        parent::__construct($baseUrl, $curl, $ua, $settings, $username, $password);
    }

    /**
     * @param EntityInterface $producer
     * @return bool
     * @throws CurlException
     */
    public function createOne(EntityInterface $producer): bool
    {
        $request = new class() { public $producer; };
        $request->producer = $producer->get();

        $payload = json_encode($request);

        $this->postRequest($this->baseUrl->__toString(), $payload);

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

    /**
     * @return array
     * @throws CurlException
     */
    public function getAll(): array
    {
        $json = $this->getRequest($this->baseUrl->__toString());
        $jsonDecoded = json_decode($json, true);

        $producers = [];

        foreach ($jsonDecoded as $data) {
            $producer = new Producer();
            $producer->set($data);

            $producers[] = $producer;
        }

        return $producers;
    }
}
