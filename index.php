<?php


require_once("./lib/App.php");
require_once("./controllers/blogs.php");

$app = new App();


$app->get("/users/:id", function ($req, $res, $next) {
  echo "middlware called <br> ";
  //var_dump($next);
  $next();
}, function ($req, $res, $next) {
  echo "Handler called";
});



$app->listen();
