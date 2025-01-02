<?php

require_once './Routes/MainRoute.php';
require_once './Controller/ControllerUser.php';


$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];

$MainRoute =new MainRoute($method , $endpoint);

$MainRoute->POST('/signup' ,ControllerUser::class, "");
$MainRoute->GET('/signin' ,ControllerUser::class, "");
$MainRoute->GET('/getdata' ,ControllerUser::class, "");

$MainRoute->Dispatch();

