<?php



require_once "Request.php";
require_once "Response.php";
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

  private function generateRequest($url): Request
  {
    $request = new Request();
    $request->method = $_SERVER['REQUEST_METHOD'];
    $rawData = file_get_contents('php://input');

    if (empty($rawData)) {
      $request->body = new stdClass();
    } else {
      $request->body = json_decode($rawData);
    }
    $request->pathName = $url;

    $request->headers["userAgent"] = $_SERVER['HTTP_USER_AGENT'];
    $request->headers["contentType"] = $_SERVER['HTTP_CONTENT_TYPE'];
    $request->headers["authorization"] = $_SERVER['HTTP_AUTHORIZATION'];

    return $request;
  }

  public function listen()
  {
    $url = parse_url($_SERVER["REQUEST_URI"])["path"];

    // set up reqest and response objects
    $request = $this->generateRequest($url);
    $response = new Response();

    // call controller function
    $handler = $this->routes[$url];
    $handler($request, $response);
  }
}
