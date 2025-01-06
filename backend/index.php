<?php

require __DIR__ .'/vendor/autoload.php';

use App\Routes\MainRoute;
use App\Controller\controlleruser;
use App\Controller\ControllerProduct;
use App\Controller\ControllerCategories;
use App\Controller\ControllerCommands;
use App\Middleware\AuthMiddleware;

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER["REQUEST_URI"];


$MainRoute =new MainRoute($method , $endpoint);

$MainRoute->post('/signup' ,ControllerUser::class, "signup");
$MainRoute->post('/signin' ,ControllerUser::class, "signin");
$MainRoute->get('/getclients' ,ControllerUser::class, "Find" , AuthMiddleware::class , true);

//activeaccount method handle also desactivation
$MainRoute->patch('/activeaccount' ,ControllerUser::class, "ActiveAccount" , AuthMiddleware::class, true);

$MainRoute->get('/getproducts' ,ControllerProduct::class, "Find");
$MainRoute->post('/addproduct' ,ControllerProduct::class, "Save" , AuthMiddleware::class);
$MainRoute->put('/updateproduct' ,ControllerProduct::class, "UpdateProduct" , AuthMiddleware::class);
$MainRoute->patch('/projectproduct' ,ControllerProduct::class, "ProjectProduct" , AuthMiddleware::class);
$MainRoute->delete('/delproduct' ,ControllerProduct::class, "DelProduct" , AuthMiddleware::class);

$MainRoute->get('/getcategories' ,ControllerCategories::class, "Find");
$MainRoute->post('/addcategorie' ,ControllerCategories::class, "Save" , AuthMiddleware::class);
$MainRoute->put('/updatecategorie' ,ControllerCategories::class, "UpdateCategorie" , AuthMiddleware::class);
$MainRoute->delete('/delcategorie' ,ControllerCategories::class, "DeleteCategorie" , AuthMiddleware::class);

$MainRoute->get('/getcommand' ,ControllerCommands::class, "Find" , AuthMiddleware::class);
$MainRoute->post('/command' ,ControllerCommands::class, "Command" , AuthMiddleware::class);
$MainRoute->delete('/cancelcommand' ,ControllerCommands::class, "DeleteCommand" , AuthMiddleware::class);


$MainRoute->Dispatch();
