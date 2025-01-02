<?php

namespace App\Exceptions;

class PDOconException extends \Exception{

    public function Message(){
        return "Server failed to make connection ,  please try later";
    }

}

?>