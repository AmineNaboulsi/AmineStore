<?php

namespace App\Models;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';


use App\Interface\ClientPrivileges;
use App\Config\Connection;
use App\Config\JwtUtil;
use App\Models\User;


class Client extends User implements ClientPrivileges {

    public bool $Active;
    public array $Panier ;
    public function __construct($name , $email , $password)
    {
        parent::__construct($name , $email , $password);
    }
   
    public function CreateAccount() : array{
        
        $con = Connection::getConnection();

        $sqldataReader = $con->prepare("SELECT email FROM Users WHERE email=:email");
        $sqldataReader->execute([
            ":email" => $this->email
        ]);
        if($sqldataReader->rowCount()==0){
            $sqldataReader = $con->prepare("INSERT INTO Users (name , email , password) Value (:name , :email , :password)");
            if(
            $sqldataReader->execute([
                ":name" => $this->name , 
                ":email" => $this->email , 
                ":password" => $this->HashedPassword()
            ])){
                $this->id = $con->lastInsertId();

                return [
                    "status" => true,
                    "message" => "Account Created Successfuly",
                    "token" => JwtUtil::generateToken($this)
                ];
            }else{
                return [
                    "status" => false,
                    "message" => "Failed to SignUp , Please try later."
                ];
            }
        }else{
            return [
                "status" => false,
                "message" => "Email All Ready Taken"
            ];
        }
    }

    public function Add_to_Panier() : void{

    }
    public function Confirm_Panier() : void{

    }
    public function Delete_from_Panier() : void{
        
    }
}

?>