<?php

namespace App\Exceptions;

class DatabaseException extends \Exception{

    public function Message(){
        return "Server failed to make connection ,Please try later";
    }

}

?>