<?php

namespace App\Routes;

class MainRoute{

    public string $method ;
    public string $uri ;
    public array $routes ;
    public function __construct($method , $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->routes = [
            'GET' => [] ,
            'POST' => [] ,
            'PUT' => [] ,
            'DELETE' => [] 
        ];
    }
    public function GET($route , $class , $method){
        $this->routes['GET'][$route] = [$class, $method];
    }
    public function POST($route , $class , $method){
        $this->routes['POST'][$route] = [$class, $method];
    }
    public function PUT($route , $class , $method){
        $this->routes['PUT'][$route] = [$class, $method];
    }
    public function DELETE($route , $class , $method){
        $this->routes['DELETE'][$route] = [$class, $method];
    }
    public function Dispatch() {
        $endpoint = strtok($this->uri, '?');
        header('Content-Type: application/json');
        if (isset($this->routes[$this->method][$endpoint])) {
            [$class, $method] = $this->routes[$this->method][$endpoint];
            $HandleClass = new $class();
            echo json_encode($HandleClass->$method());
        }else{
            //throw new InvalideRoute("Route not found");
            echo json_encode([
                "status" => false,
                "message" => "Invalid Route"
            ]);
        }
    }
}

?>