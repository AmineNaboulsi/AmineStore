<?php
require __DIR__ .'/vendor/autoload.php';

use App\Routes\MainRoute;


$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];

$MainRoute =new MainRoute($method , $endpoint);

$MainRoute->POST('/signup' ,ControllerUser::class, "");
$MainRoute->GET('/signin' ,ControllerUser::class, "");
$MainRoute->GET('/getdata' ,ControllerUser::class, "");

$MainRoute->Dispatch();

