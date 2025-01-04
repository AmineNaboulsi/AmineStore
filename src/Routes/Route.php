<?php

namespace App\Routes;

use App\Middleware\AuthMiddleware;
class Route{

    public string $method;
    public $class;
    public $HandelAuthMiddleware = null;

    public function __construct($method ,$class , $HandelAuthMiddleware)
    {
        $this->method = $method;
        $this->class = $class;
        $this->HandelAuthMiddleware = $HandelAuthMiddleware;
    }
    public function getMiddleware()
    {
        return $this->HandelAuthMiddleware;
    }
    public  function getClass(){ return $this->class;}
    public  function getMethod() { return $this->method;}

    public function __toString() : string
    {
        return
            "method : " . $this->method  ;

    }
}

?>