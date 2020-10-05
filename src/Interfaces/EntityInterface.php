<?php
// src/Interfaces/EntityInterface.php

namespace RestClient\Interfaces;

interface EntityInterface
{
    /**
     * @return array
     */
    public function get(): array;

    /**
     * @param array $data
     */
    public function set(array $data): void;
}
