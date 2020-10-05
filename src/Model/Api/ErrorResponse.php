<?php
// src/Model/Api/ErrorResponse.php

namespace RestClient\Model\Api;

class ErrorResponse
{
    /**
     * @var string
     */
    public $version;

    /**
     * @var bool
     */
    public $success;

    /**
     * @var object
     */
    public $data;

    /**
     * @var Error
     */
    public $error;
}
