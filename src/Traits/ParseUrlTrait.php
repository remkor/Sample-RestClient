<?php
// src/Traits/ParseUrlTrait.php

namespace RestClient\Traits;

trait ParseUrlTrait
{
    /**
     * @param string $url
     * @return array
     */
    protected function parseUrl(string $url): array
    {
        $parsed = parse_url($url);

        $parsed += [
            'scheme' => '',
            'host' => '',
            'port' => '',
            'path' => '',
            'query' => '',
            'fragment' => '',
            'user' => '',
            'pass' => '',
        ];

        return $parsed;
    }
}
