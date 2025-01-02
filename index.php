<?php

require_once './Controller/controlleruser.php';


$method = $_SERVER['REQUEST_METHOD'];

$url = $_POST['url'] ?? null;

$routes = [
    'adduser' => [controlleruser::class, 'adduser']
];

if (isset($routes[$url])) {
    [$controllerClass, $methodName] = $routes[$url];

    $object = new $controllerClass();
    $object->$methodName();
 
} else {
    http_response_code(404);
    echo "Route not found.";
}
