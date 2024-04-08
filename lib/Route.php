<?php


class Route
{
    private $handlers;
    private $path;
    private $method;
    private $params;
    public function __construct(string $path, string $method, array $params, array $handlers)
    {
        $this->handlers = $handlers;
        $this->path = $path;
        $this->method = $method;
        $this->params = $params;
    }
    public function invokeRoute()
    {
        $newRoute = new stdClass;

        $newRoute->path = $this->path;
        $newRoute->method = $this->method;
        $newRoute->handlers = $this->handlers;
        $newRoute->params = $this->params;
        return $newRoute;
    }
};
