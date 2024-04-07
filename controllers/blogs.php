<?php

include "../lib/Request.php";
include "../lib/Response.php";


$createBlog = function (Request $req, Response  $res) {

  var_dump($req);
  echo 'create blog endpoint';
};

$fetchBlogs = function () {
  echo "fetch blogs endpoint";
};

$updateBlogs = function () {
  echo "update blog endpoint";
};
