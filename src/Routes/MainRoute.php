<?php

namespace App\Routes;
use App\Controller\controlleruser;
use App\Routes\Route;
use App\Middleware\AuthMiddleware;
use App\Config\JwtUtil;
class MainRoute{

    public string $method ;
    public string $uri ;
    public array $routes ;

    public function __construct($method , $uri){
        $this->method = $method;
        $this->uri = $uri;
        $this->routes = [
            'GET' => [] ,
            'POST' => [] ,
            'PUT' => [] ,
            'DELETE' => [] 
        ];
    }
    //GET
    public function get($route , $class , $method , $middleware = null)
    { $this->routes['GET'][$route] = new Route($method,$class,$middleware );}
    
    //POST
    public function post($route , $class , $method, $middleware = null)
    { $this->routes['POST'][$route] = new Route($method,$class,$middleware );}
    
    //PUT
    public function put($route , $class , $method, $middleware = null)
    { $this->routes['PUT'][$route] = new Route($method,$class ,$middleware );}
    
    //DELETE
    public function delete($route , $class , $method, $middleware = null)
    { $this->routes['DELETE'][$route] = new Route($method,$class ,$middleware );}

    //Dispatch
    public function Dispatch() {
        $endpoint = strtok($this->uri, '?');
        header('Content-Type: application/json');
        $isFound=false;
        foreach ($this->routes[$this->method] as $routeaction => $routeO) {
            if ($routeaction === $endpoint) {
                $class = $routeO->getClass();
                $method = $routeO->getMethod();
                //echo 'getMiddleware : '.$routeO->getMiddleware();
                if($routeO->getMiddleware()){
                    echo json_encode([
                        "status" => false,
                        "message" => "Unauthorized access. Please log in."
                    ]);
                    return ;
                }

                $instance = new $class();;
                echo json_encode($instance->$method());

                $isFound = true;
                return;
            }
        }
        if(!$isFound){
                echo json_encode([
                    "status" => false,
                    "message" => "Invalid Route"
                ]);
        }
    }

}

?>