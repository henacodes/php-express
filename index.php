<?php


require_once("./lib/App.php");
require_once("./controllers/blogs.php");

$app = new App();


$app->route("/contacts", function () {
  echo 'handler function called ';
});

$app->route("/blogs/create", $createBlog);
$app->route("/blogs/get", $fetchBlogs);
$app->listen();


/*
$rawData = file_get_contents('php://input');
$jsonData = json_decode($rawData);

var_dump($jsonData->name);

$newObject = new stdClass();
var_dump($newObject);


$method = $_SERVER['REQUEST_METHOD'];
var_dump($method);
*/