<?php
// tests/Connection/ProducersConnectorTest.php

namespace Tests\Connection;

use PHPUnit\Framework\TestCase;
use RestClient\Connection\ProducersConnector;
use RestClient\Entity\Producer;
use RestClient\Exception\CurlException;
use RestClient\Interfaces\Api\CreateOneInterface;
use RestClient\Interfaces\Api\GetAllInterface;

class ProducersConnectorTest extends TestCase
{
    const BASE_URL = 'http://rekrutacja.localhost:8091/shop_api/v1/producers';
    const UA = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1';

    const USERNAME = 'rest';
    const PASSWORD = 'vKTUeyrt1!';

    public function testConstruct()
    {
        $connector = new ProducersConnector(self::BASE_URL, false);

        $this->assertInstanceOf(CreateOneInterface::class, $connector);
        $this->assertInstanceOf(GetAllInterface::class, $connector);
    }

    public function testCreateOne()
    {
        $connector = new ProducersConnector(
            self::BASE_URL,
            false,
            self::UA,
            [],
            self::USERNAME,
            self::PASSWORD);

        $producer = new Producer();

        $producer->id = rand();
        $producer->name = 'TEST';
        $producer->logoFilename = 'TEST';
        $producer->ordering = 123;

        try {
            $result = $connector->createOne($producer);

            $this->assertTrue($result);
        }
        catch (CurlException $exc) {
            $this->fail($exc->getMessage());
        }
    }

    public function testGetAll()
    {
        $connector = new ProducersConnector(
            self::BASE_URL,
            false,
            self::UA,
            [],
            self::USERNAME,
            self::PASSWORD);

        try {
            $producers = $connector->getAll();

            $this->assertNotEmpty($producers);

            /** @var Producer $producer */
            foreach ($producers as $producer) {
                $this->assertInstanceOf(Producer::class, $producer);

                $this->assertNotEmpty($producer->id);
                $this->assertNotEmpty($producer->name);
            }
        }
        catch (CurlException $exc) {
            $this->fail($exc->getMessage());
        }
    }
}
