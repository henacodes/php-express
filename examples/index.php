<?php


require_once("../src/App.php");
//require_once("./controllers/blogs.php");

$app = new App();


$app->get("/users/:id", function ($req, $res, $next) {
    $next();
}, function ($req, $res, $next) {
    $res->json(["name" => "henok"]);
});



$app->listen();
