<?php

$data = array(
    'name' => 'John Doe',
    'age' => 30,
    'city' => 'New York'
);

header('Content-Type: application/json');
echo json_encode($data);


$html = '<html><body><h1>Hello, World!</h1></body></html>';

header('Content-Type: text/html');
echo $html;


$body = file_get_contents('php://input');

// Do something with the request body...

//$requestBody = file_get_contents('php://input');



//var_dump($requestBody);
// Create a PHP array or object with the data you want to respond with
$data = [
    'name' => 'John Doe',
    'age' => 30,
    'email' => 'john@example.com'
];

// Convert the array or object to a JSON string
$jsonResponse = json_encode($data);

// Set the response headers to indicate JSON content
header('Content-Type: application/json');

// Echo the JSON string as the response
echo $jsonResponse;
