<?php

// require_once '/../Config/Connection.php';
// require_once realpath(__DIR__ . '/../Config/Connection.php') ;

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

    public function SeConnecter(){
        $con = Connection::getConnection();
    }

    public function SeDonnecter(){
        $con = Connection::getConnection();
    }
    
}

?>