<?php

/*
require_once("./PathToRegExp.php");

$keys = [];
$regexpp = PathToRegexp::convert("/users/:id", $keys);

$match1 = PathToRegexp::match($regexpp, "/posts");
$match2 = PathToRegexp::match($regexpp, "/users");
$match3 = PathToRegexp::match($regexpp, "/users/something");
$match4 = PathToRegexp::match($regexpp, "/users/doctors");
$match5 = PathToRegexp::match($regexpp, "/users/doctors/23242");

var_dump($match1);
var_dump($match2);
var_dump($match3);
var_dump($match4);
var_dump($match5);

 
*/

class Route
{
    private $handler;
    private $path;
    private $method;
    private $params;
    public function __construct(callable $handler, string $path, string $method, array $params)
    {
        $this->handler = $handler;
        $this->path = $path;
        $this->method = $method;
        $this->params = $params;
    }
    public function invokeRoute()
    {
        $newRoute = new stdClass;

        $newRoute->path = $this->path;
        $newRoute->method = $this->method;
        $newRoute->handler = $this->handler;
        $newRoute->params = $this->params;
        return $newRoute;
    }
};
