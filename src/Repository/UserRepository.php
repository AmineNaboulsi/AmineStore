<?php

namespace App\Repository;

use App\Config\Connection;
use App\Config\JwtUtil;
use App\Models\User;

class UserRepository{

    public function __construct() {
    }

    // Find product by ID
    public function findById(int $id): User {
        return new User('d','q','d');
    }
    // create new account 
    public function Save(User $user) : array{
        
        $con = Connection::getConnection();

        $sqldataReader = $con->prepare("SELECT email FROM Users WHERE email=:email");
        $sqldataReader->execute([
            ":email" => $user->email
        ]);
        if($sqldataReader->rowCount()==0){
            $sqldataReader = $con->prepare("INSERT INTO Users (name , email , password) Value (:name , :email , :password)");
            if(
            $sqldataReader->execute([
                ":name" => $user->name , 
                ":email" => $user->email , 
                ":password" => $user->HashedPassword()
            ])){
                $user->id = $con->lastInsertId();

                return [
                    "status" => true,
                    "message" => "Account Created Successfuly",
                    "token" => JwtUtil::generateToken($user)
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

    public function UnBanned(User $user): void {
        $con = Connection::getConnection();

    }
    public function Banned(User $user): void {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("UPDATE Users SET (name , email , password) Value (:name , :email , :password)");
        if(
            $sqldataReader->execute([
                ":name" => $user->name ,
                ":email" => $user->email ,
                ":password" => $user->HashedPassword()
            ])){
            $user->id = $con->lastInsertId();

            return [
                "status" => true,
                "message" => "Account Created Successfuly",
                "token" => JwtUtil::generateToken($user)
            ];
        }else{
            return [
                "status" => false,
                "message" => "Failed to SignUp , Please try later."
            ];
        }
    }
    // Update client account from database
    public function findByIdAndUpdate(User $user): void {
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