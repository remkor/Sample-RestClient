<?php
// tests/Client/ClientFactoryTest.php

namespace Tests\Client;

use PHPUnit\Framework\TestCase;
use RestClient\Client\Client;
use RestClient\Client\ClientFactory;

class ClientFactoryTest extends TestCase
{
    const BASE_URL = 'http://rekrutacja.localhost:8091';
    const UA = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1';

    public function testCreateClient()
    {
        $client = (new ClientFactory())->createClient(self::BASE_URL, self::UA);

        $this->assertInstanceOf(Client::class, $client);
    }
}
