<?php

class Request
{
    public $body;
    public $headers;
    public $content_type;

    public $method;
    public $pathName;
    public $query;
    public $protocol;

    public function __construct($body = [], $pathName = "/", $query = [], $method = "GET", $headers = [], $protocol = "http")
    {
        $this->body = $body;
        $this->headers = $headers;
        $this->pathName = $pathName;
        $this->query = $query;
        $this->method = $method;
        $this->protocol = $protocol;
    }
}
