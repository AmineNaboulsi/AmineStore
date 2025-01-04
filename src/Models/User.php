<?php

namespace App\Models;
use App\Config\Connection;

abstract class User {

    public int $id ; 
    public string $name ; 
    public string $email ; 
    private string $password ; 
    
    public function __construct($name , $email , $password)
    {
        $this->name =  $name ;
        $this->email =  $email ;
        $this->password =  $password ;
    }

    public function HashedPassword() {return password_hash($this->password , PASSWORD_DEFAULT);}

}

?>