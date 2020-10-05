<?php
// src/Entity/Producer.php

namespace RestClient\Entity;

use RestClient\Interfaces\EntityInterface;
use RestClient\Traits\GetSetTrait;

class Producer implements EntityInterface
{
    use GetSetTrait;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $siteUrl;

    /**
     * @var string
     */
    public $logoFilename;

    /**
     * @var int
     */
    public $ordering;

    /**
     * @var string
     */
    public $sourceId;
}
