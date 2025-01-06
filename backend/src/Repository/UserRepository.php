<?php

namespace App\Repository;

use App\Config\Connection;
use App\Config\JwtUtil;
use App\Models\Client;
use App\Models\User;
class UserRepository{

    public function __construct() {
    }
    //Find All
    public function Find() {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("
        SELECT u.id_u , u.name , u.email , u.Active  FROM Users u
        JOIN UserRoles ur ON ur.id_u = u.id_u
        JOIN Roles r ON r.id_r = ur.id_r
        WHERE r.id_r = 2 
        ");

        $sqldataReader->execute();
        return $sqldataReader->fetchAll(\PDO::FETCH_ASSOC);
    }
    // Find product by ID
    public function findRoleById(int $id) {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("
            SELECT role_name FROM Users u
            JOIN UserRoles ur ON ur.id_u = u.id_u
            JOIN Roles r ON r.id_r = ur.id_r
            WHERE u.id_u=:id_u ");
        $sqldataReader->execute([
            ":id_u" => $id
        ]);
        $sqldataReader = $sqldataReader->fetch();
        return $sqldataReader['role_name'];
    }
    // create new account
    public function SignIn(string $email, string $password)
    {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("SELECT id_u, password , Active FROM Users WHERE email=:email");
        $sqldataReader->execute([
            ":email" => $email
        ]);
        $sqldataReader = $sqldataReader->fetch();
        if($sqldataReader){
             if(password_verify($password, $sqldataReader['password'] )){
                if($sqldataReader['Active']==0){
                    return [
                        "status" => false,
                        "message" => "Your account closed for the moment, please try again later"
                    ];
                }
                 $user = new Client('',$email,'');
                 $user->id = $sqldataReader['id_u'] ;
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
    public function save(Client $user): array
    {
        $con = Connection::getConnection();
        try {
            $checkQuery = $con->prepare("SELECT email FROM Users WHERE email = :email");
            $checkQuery->execute([":email" => $user->email]);

            if ($checkQuery->rowCount() > 0) {
                return [
                    "status" => false,
                    "message" => "Email already taken."
                ];
            }

            $con->beginTransaction();

            $userQuery = $con->prepare("
            INSERT INTO Users (name, email, password, Active) 
            VALUES (:name, :email, :password, 1)");
            $userInserted = $userQuery->execute([
                ":name" => $user->name,
                ":email" => $user->email,
                ":password" => $user->HashedPassword()
            ]);

            if (!$userInserted) {
                $con->rollBack();
                return [
                    "status" => false,
                    "message" => "Failed to sign up. Please try again later."
                ];
            }

            $user->id = $con->lastInsertId();

            $roleQuery = $con->prepare("
            INSERT INTO UserRoles (id_u, id_r) 
            VALUES (:id_u, :id_r)
        ");
            $roleInserted = $roleQuery->execute([
                ":id_u" => $user->id,
                ":id_r" => $this->getRoleId("client")
            ]);

            if (!$roleInserted) {
                $con->rollBack();
                return [
                    "status" => false,
                    "message" => "Failed to assign role. Please try again later."
                ];
            }

            $con->commit();

            return [
                "status" => true,
                "message" => "Account created successfully."
            ];
        } catch (\Exception $e) {
            $con->rollBack();
            return [
                "status" => false,
                "message" => "An error occurred: Failed to createthis account " 
            ];
        }
    }

    private function getRoleId(string $roleName): int
    {
        $con = Connection::getConnection();
        $roleQuery = $con->prepare("SELECT id_r FROM Roles WHERE role_name = :role_name");
        $roleQuery->execute([":role_name" => $roleName]);

        $role = $roleQuery->fetch(\PDO::FETCH_ASSOC);
        return $role ? $role['id_r'] : 0;
    }


    public function BannedOrUnBanned(Client $user) {
        $con = Connection::getConnection();
        $sqldataReader = $con->prepare("UPDATE Users SET Active=:etat WHERE id_u=:id");
        if(
            $sqldataReader->execute([
                ":etat" => $user->Active?1:0 ,
                ":id" => $user->id
            ])){
            return [
                "status" => true,
                "message" => "Account ".($user->Active ? 'UnBanned' : 'Banned')." Successfuly"
            ];
        }else{
            return [
                "status" => false,
                "message" => "Failed to ".($user->Active ? 'UnBanned' : 'Banned')." Client , Please try again later."
            ];
        }
    }

    public function Confirm_Panier() : void{

    }
}

?>