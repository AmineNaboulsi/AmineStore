<?php

namespace App\Exceptions;

class InvalideRoute extends \Exception{

    public function Message(){
        return "Invalid Route";
    }

}