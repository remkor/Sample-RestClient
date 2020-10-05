<?php
// tests/Model/Psr7/UriTest.php

namespace Tests\Model\Psr7;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;
use RestClient\Model\Psr7\Uri;

class UriTest extends TestCase
{
    const URL = 'http://rekrutacja.localhost:8091/shop_api/v1/producers';

    public function testConstruct()
    {
        $uri = new Uri();

        $this->assertInstanceOf(Uri::class, $uri);
        $this->assertInstanceOf(UriInterface::class, $uri);

        $this->assertEmpty($uri->getScheme());
        $this->assertEmpty($uri->getAuthority());
        $this->assertEmpty($uri->getUserInfo());
        $this->assertEmpty($uri->getHost());
        $this->assertEmpty($uri->getPort());
        $this->assertEmpty($uri->getPath());
        $this->assertEmpty($uri->getQuery());
        $this->assertEmpty($uri->getFragment());
    }

    public function testInitWithString()
    {
        $uri = Uri::initWithString(self::URL);

        $this->assertInstanceOf(Uri::class, $uri);
        $this->assertInstanceOf(UriInterface::class, $uri);

        $this->assertEquals('http', $uri->getScheme());
        $this->assertEquals('rekrutacja.localhost:8091', $uri->getAuthority());
        $this->assertEquals('', $uri->getUserInfo());
        $this->assertEquals('rekrutacja.localhost', $uri->getHost());
        $this->assertEquals(8091, $uri->getPort());
        $this->assertEquals('/shop_api/v1/producers', $uri->getPath());
        $this->assertEmpty($uri->getQuery());
        $this->assertEmpty($uri->getFragment());

        $this->assertEquals(self::URL, $uri->__toString());
    }
}
