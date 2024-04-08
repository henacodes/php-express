<?php



require_once "Request.php";
require_once "Response.php";
require_once "Route.php";
require_once "PathToRegExp.php";
class App
{

  private $routes = [];

  public function __construct()
  {
  }

  private  function match($inputRoute, string $method): ?array
  {


    foreach ($this->routes as $route) {
      $routeRexExp = PathToRegexp::convert($route->invokeRoute()->path);
      $match = PathToRegexp::match($routeRexExp, $inputRoute);
      if (empty($match)) {
        return null;
      } else {

        if ($method === $route->invokeRoute()->method) {
          $params = array_combine($route->invokeRoute()->params, array_slice($match, 1));
          return [
            "params" => $params,
            "handler" => $route->invokeRoute()->handler,
            "method" => $route->invokeRoute()->method,
          ];
        } else {
          return null;
        }
      }
    }
  }

  public function route($route,  callable $handler, $method)
  {
    $params = $this->extractParams($route);
    $newRoute = new Route($handler, $route, $method, $params);
    $this->routes[] = $newRoute;
  }


  private function extractParams($route): array
  {
    $routeRexEx = PathToRegexp::convert($route);
    $params = array_slice(PathToRegexp::match($routeRexEx, $route), 1);
    return $params;
  }
  public function get($route, callable $handler)
  {
    $this->route($route, $handler, "GET");
  }
  public function post($route, callable $handler)
  {
    $this->route($route, $handler, "POST");
  }
  public function put($route, callable $handler)
  {
    $this->route($route, $handler, "PUT");
  }
  public function patch($route, callable $handler)
  {
    $this->route($route, $handler, "PATCH");
  }

  private function generateRequest(string $url): Request
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
    $path = parse_url($_SERVER["REQUEST_URI"])["path"];


    // set up reqest and response objects
    $request = $this->generateRequest($path);
    $response = new Response();



    // call controller function
    $route = $this->match((string) $path, $request->method);

    if ($route) {

      $route["query"] = $_GET;
      var_dump($route);
      $route["handler"]();
    } else {
      $response->status(404);
      echo "Not found";
    }
  }
}
