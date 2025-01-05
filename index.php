<?php

require __DIR__ .'/vendor/autoload.php';

use App\Routes\MainRoute;
use App\Controller\controlleruser;
use App\Controller\ControllerProduct;
use App\Middleware\AuthMiddleware;

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER["REQUEST_URI"];


$MainRoute =new MainRoute($method , $endpoint);

$MainRoute->post('/signup' ,ControllerUser::class, "signup");
$MainRoute->post('/signin' ,ControllerUser::class, "signin");

$MainRoute->get('/getproducts' ,ControllerProduct::class, "Find");
$MainRoute->post('/addproduct' ,ControllerProduct::class, "Save" , AuthMiddleware::class);
$MainRoute->put('/updateproduct' ,ControllerProduct::class, "UpdateProduct" , AuthMiddleware::class);
$MainRoute->delete('/delproduct' ,ControllerProduct::class, "DelProduct" , AuthMiddleware::class);

$MainRoute->get('/getproducts' ,ControllerProduct::class, "Find");
$MainRoute->post('/addproduct' ,ControllerProduct::class, "Save" , AuthMiddleware::class);
$MainRoute->put('/updateproduct' ,ControllerProduct::class, "UpdateProduct" , AuthMiddleware::class);
$MainRoute->delete('/delproduct' ,ControllerProduct::class, "DelProduct" , AuthMiddleware::class);


$MainRoute->Dispatch();
