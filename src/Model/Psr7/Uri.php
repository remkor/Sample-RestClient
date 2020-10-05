<?php
// src/Model/Psr7/Uri.php

namespace RestClient\Model\Psr7;

use Psr\Http\Message\UriInterface;
use RestClient\Traits\ParseUrlTrait;

class Uri implements UriInterface
{
    use ParseUrlTrait;


    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $host;

    /**
     * @var null|int
     */
    private $port;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $fragment;


    /**
     * Uri constructor
     */
    public function __construct()
    {
        $this->scheme = '';
        $this->user = '';
        $this->password = '';
        $this->host = '';
        $this->port = null;
        $this->path = '';
        $this->query = '';
        $this->fragment = '';
    }

    /**
     * @param string $uri
     * @return Uri
     */
    public static function initWithString(string $uri): Uri
    {
        $instance = new self();

        $parsed = $instance->parseUrl($uri);

        $instance->scheme = $parsed['scheme'];
        $instance->user = $parsed['user'];
        $instance->password = $parsed['pass'];
        $instance->host = $parsed['host'];
        $instance->port = (int) $parsed['port'];
        $instance->path = $parsed['path'];
        $instance->query = $parsed['query'];
        $instance->fragment = $parsed['fragment'];

        return $instance;
    }


    /**
     * @inheritDoc
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @inheritDoc
     */
    public function withScheme($scheme): Uri
    {
        $clone = clone $this;
        $clone->scheme = $scheme;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getAuthority(): string
    {
        $userInfo = $this->getUserInfo();

        $host = $this->getHost();
        $port = $this->getPort();

        $authority = '';

        $authority .= empty($userInfo) ? '' : $userInfo . '@';
        $authority .= $host;
        $authority .= empty($port) ? '' : ':' . $port;

        return $authority;
    }

    /**
     * @inheritDoc
     */
    public function getUserInfo(): string
    {
        $userInfo = $this->user;

        if (!empty($this->password)) {
            $userInfo .= ':' . $this->password;
        }

        return $userInfo;
    }

    /**
     * @inheritDoc
     */
    public function withUserInfo($user, $password = null): Uri
    {
        $clone = clone $this;
        $clone->user = $user;
        $clone->password = '';

        if (!empty($password)) {
            $clone->password = $password;
        }

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @inheritDoc
     */
    public function withHost($host)
    {
        $clone = clone $this;
        $clone->host = $host;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @inheritDoc
     */
    public function withPort($port): Uri
    {
        $clone = clone $this;
        $clone->port = $port;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function withPath($path): Uri
    {
        $clone = clone $this;
        $clone->path = $path;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @inheritDoc
     */
    public function withQuery($query): Uri
    {
        $clone = clone $this;
        $clone->query = $query;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * @inheritDoc
     */
    public function withFragment($fragment)
    {
        $clone = clone $this;
        $clone->fragment = $fragment;

        return $clone;
    }


    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $scheme = $this->getScheme();
        $authority = $this->getAuthority();
        $path = '/' . ltrim($this->getPath(), '/');
        $query = $this->getQuery();
        $fragment = $this->getFragment();

        $string = '';

        $string .= empty($scheme) ? '' : $scheme . ':';
        $string .= empty($authority) ? '' : '//' . $authority;
        $string .= $path;
        $string .= empty($query) ? '' : '?' . $query;
        $string .= empty($fragment) ? '' : '#' . $fragment;

        return $string;
    }
}
