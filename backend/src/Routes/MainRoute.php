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
            'DELETE' => [] ,
            'PATCH' => [] ,
        ];
    }
    //GET
    public function get($route , $class , $method , $middleware = null , $isAdmin = false)
    { $this->routes['GET'][$route] = new Route($method,$class,$middleware,$isAdmin);}
    
    //POST
    public function post($route , $class , $method, $middleware = null, $isAdmin = false)
    { $this->routes['POST'][$route] = new Route($method,$class,$middleware,$isAdmin);}
    
    //PUT
    public function put($route , $class , $method, $middleware = null, $isAdmin = false)
    { $this->routes['PUT'][$route] = new Route($method,$class ,$middleware,$isAdmin);}

    //PATCH
    public function patch($route , $class , $method, $middleware = null, $isAdmin = false)
    { $this->routes['PATCH'][$route] = new Route($method,$class ,$middleware,$isAdmin );}

    //DELETE
    public function delete($route , $class , $method, $middleware = null, $isAdmin = false)
    { $this->routes['DELETE'][$route] = new Route($method,$class ,$middleware ,$isAdmin );}

    //Dispatch
    public function Dispatch() {
        $endpoint = strtok($this->uri, '?');
        header('Content-Type: application/json');
        $isFound=false;
        foreach ($this->routes[$this->method] as $routeaction => $routeObj) {
            if ($routeaction === $endpoint) {
                $class = $routeObj->getClass();
                $method = $routeObj->getMethod();
                $middleware = $routeObj->getMiddleware();
                $isAdmin = $routeObj->isAdmin();
                $class =new $class();
                if($middleware){
                    $response = $middleware::handle($isAdmin ,function () use ($class, $method) {
                        return $class->$method();
                    });
                    echo json_encode($response);
                    return ;
                }
                echo json_encode($class->$method());
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