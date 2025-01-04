<?php

namespace App\Controller;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';

use App\Models\Client;
use App\Repository\UserRepository;


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
            $ClientRepository = new UserRepository();
            return $ClientRepository->Save($Client);
        }
            return [
                "status" => false,
                "message" => "Missing parametres"
            ];
    }
    public function signin(){
        $parametres = ["email" , "password"];
        $missingparam = array_filter($parametres , function($parametre){
            if(!isset($_POST[$parametre])) return $parametre;
        });
        if(!$missingparam){

            $email = $_POST["email"];
            $password = $_POST["password"];

            $ClientRepository = new UserRepository();
            return $ClientRepository->SignIn($email , $password);
        }
        return [
            "status" => false,
            "message" => "Missing parametres"
        ];
    }
}
?>