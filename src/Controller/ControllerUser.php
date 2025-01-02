<?php

namespace App\Controller;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';

use App\Models\Client ;
class controlleruser{

    public function __construct()
    {
        
    }
    public function signup(){
        $parametres = ["name" , "email" , "password"];
        $missingparam = array_filter($parametres , function($parametre){
            if(!isset($_POST[$parametre])) return $parametre;
        });
        if(!$missingparam){
            
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            $Client = new Client($name , $email ,$password);
            return $Client->CreateAccount();
        }
            return [
                "status" => false,
                "message" => "Missing parametres"
            ];
    }
   public function signin(){
        
    }
}
?>