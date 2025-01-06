<?php

namespace App\Controller;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';

use App\Models\Client;
use App\Repository\UserRepository;
use App\Middleware\AuthMiddleware;


class controlleruser{

    public function signup(){
        $parametres = ["name" , "email" , "password"];
        $missingparam = array_filter($parametres , function($parametre){
            if(!isset($_POST[$parametre]) && empty($_POST[$parametre])) return $parametre;
        });
        if(!$missingparam){

            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return [
                    "status" => false,
                    "message" => "Invalid email format"
                ];
            }
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
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return [
                    "status" => false,
                    "message" => "Invalid email format"
                ];
            }

            $ClientRepository = new UserRepository();
            return $ClientRepository->SignIn($email , $password);
        }
        return [
            "status" => false,
            "message" => "Missing parametres"
        ];
    }

    public function ActiveAccount(){
        $parametres = ["id" , "etat"];
        $missingparam = array_filter($parametres , function($parametre){
            if(!isset($_GET[$parametre])) return $parametre;
        });
        if(!$missingparam){

            $id = $_GET["id"];
            $etat = $_GET["etat"];
            $User = new Client();
            $User->id = $id;
            $User->Active = $etat;
            $ClientRepository = new UserRepository();
            return $ClientRepository->BannedOrUnBanned($User);
        }
        else
            return [
                "status" => false,
                "message" => "Missing parametres"
            ];
    }

    public function Find()
    {
        $UserRepository = new UserRepository();
        return $UserRepository->Find();
    }

    public function validetk()  {
        return AuthMiddleware::isValideTK();
    }
}
?>