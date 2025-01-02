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
    public function Dispatch(){
        // print_r($this->routes);
        // class_exists()

        $endpoint = strtok($this->uri);
        echo "zbi";
    }
}

?>