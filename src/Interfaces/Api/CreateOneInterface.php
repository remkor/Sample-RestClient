<?php
// src/Interfaces/Api/CreateOneInterface.php

namespace RestClient\Interfaces\Api;

use RestClient\Interfaces\EntityInterface;

interface CreateOneInterface
{
    /**
     * @param EntityInterface $entity
     * @return bool
     */
    function createOne(EntityInterface $entity): bool;
}
