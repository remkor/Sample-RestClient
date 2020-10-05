<?php
// src/Client/ClientFactory.php

namespace RestClient\Client;

class ClientFactory
{
    public function createClient(string $baseUrl, string $ua): Client
    {
        $client = new Client($baseUrl, $ua);

        $client->addProducersConnector();

        return $client;
    }
}
