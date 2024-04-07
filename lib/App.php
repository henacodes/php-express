<?php



include "./Request.php";
class App
{

  private $routes = [];

  public function __construct()
  {
  }

  public function route($route,  callable $handler)
  {
    $this->routes[$route] = $handler;
  }


  public function listen()
  {
    $url = parse_url($_SERVER["REQUEST_URI"])["path"];


    // set up  request object
    $request = new Request();
    $request->method = $_SERVER['REQUEST_METHOD'];
    $rawData = file_get_contents('php://input');

    if (empty($rawData)) {
      $request->body = new stdClass();
    } else {
      $request->body = json_decode($rawData);
    }
    $request->pathName = $url;



    // call controller function
    $handler = $this->routes[$url];
    $handler();
  }
}
