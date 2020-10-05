<?php
// src/Traits/GetSetTrait.php

namespace RestClient\Traits;

trait GetSetTrait
{
    use CamelCaseTrait;

    /**
     * @return array
     */
    public function get(): array
    {
        $data = [];

        foreach ($this as $property => $value) {
            $key = $this->camelCaseReverseTransform($property);

            $data[$key] = $value;
        }

        return $data;
    }

    /**
     * @param array $data
     */
    public function set(array $data): void
    {
        foreach ($data as $key => $value) {
            $property = $this->camelCaseTransform($key);

            $this->{$property} = $value;
        }
    }
}
