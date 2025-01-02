<?php

require __DIR__ .'/vendor/autoload.php';

use App\Routes\MainRoute;
use App\Controller\controlleruser;


$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER["REQUEST_URI"];


$MainRoute =new MainRoute($method , $endpoint);

$MainRoute->POST('/signup' ,ControllerUser::class, "signup");
$MainRoute->POST('/signin' ,ControllerUser::class, "signin");
// $MainRoute->GET('/getdata' ,ControllerUser::class, "");

$MainRoute->Dispatch();

