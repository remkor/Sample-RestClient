<?php
// src/Traits/CamelCaseTrait.php

namespace RestClient\Traits;

trait CamelCaseTrait
{
    /**
     * @param string $name
     * @return string
     */
    protected function camelCaseTransform(string $name): string
    {
        return str_replace('_', '', lcfirst(ucwords($name, '_')));
    }

    /**
     * @param string $name
     * @return string
     */
    protected function camelCaseReverseTransform(string $name): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
    }
}
