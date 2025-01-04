<?php

namespace App\Repository;

use App\Config\Connection;
use App\Config\JwtUtil;
use App\Models\Client;
use App\Models\User;
class UserRepository{

    public function __construct() {
    }

    // Find product by ID
    public function findById(int $id) {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("SELECT password FROM Users WHERE id_u=:id_u");
        $sqldataReader->execute([
            ":id_u" => $id
        ]);
        $sqldataReader = $sqldataReader->fetch();
        if($sqldataReader){
            $Client = new Client('d','q','d');
            return [
                "Data" => $Client->__toString()
            ];
        }else{
            return null;
        }
    }
    // create new account
    public function SignIn(string $email, string $password)
    {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("SELECT password FROM Users WHERE email=:email");
        $sqldataReader->execute([
            ":email" => $email
        ]);
        $sqldataReader = $sqldataReader->fetch();
        if($sqldataReader){
             if(password_verify($password, $sqldataReader['password'] )){
                 $user = new Client('',$email,'');
                 $user->id = $con->lastInsertId();
                 return [
                     "status" => true,
                     "message" => "Login successfuly",
                     "token" => JwtUtil::generateToken($user)
                 ];
             }else{
                 return [
                     "status" => false,
                     "message" => "Invalid email or password."
                 ];
             }
        }
        else{
            return [
                "status" => false,
                "message" => "Invalid email or password."
            ];
        };
    }
    public function Save(Client $user) : array{
        
        $con = Connection::getConnection();

        $sqldataReader = $con->prepare("SELECT email FROM Users WHERE email=:email");
        $sqldataReader->execute([
            ":email" => $user->email
        ]);
        if($sqldataReader->rowCount()==0){
            $sqldataReader = $con->prepare("INSERT INTO Users (name , email , password , Active) Value (:name , :email , :password , 1)");
            if(
            $sqldataReader->execute([
                ":name" => $user->name , 
                ":email" => $user->email , 
                ":password" => $user->HashedPassword()
            ])){
                $user->id = $con->lastInsertId();

                return [
                    "status" => true,
                    "message" => "Account Created Successfuly"
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

    public function UnBanned(User $user) {
        $con = Connection::getConnection();

    }
    public function Banned(User $user) {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("UPDATE Users SET Active=:etat ");
        if(
            $sqldataReader->execute([
                ":etat" => $user->name ,
                ":email" => $user->email ,
                ":password" => $user->HashedPassword()
            ])){
            $user->id = $con->lastInsertId();

            return [
                "status" => true,
                "message" => "Account Banned Successfuly"
            ];
        }else{
            return [
                "status" => false,
                "message" => "Account UnBanned Successfuly"
            ];
        }
    }
    // Update client account from database
    public function findByIdAndUpdate(User $user) {
        $con = Connection::getConnection();

    }
    // Delete client account from database
    public function findByIdAndDelete(User $user): void {
       
    }

    public function Add_to_Panier() : void{

    }
    public function Confirm_Panier() : void{

    }
    public function Delete_from_Panier() : void{
        
    }
}

?>