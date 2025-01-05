<?php

namespace App\Repository;

use App\Config\Connection;
use App\Models\Categorie;

class CategorieRepository
{
    public function Find(){
        $con = Connection::getConnection();

        $sqlDataReader  = $con->prepare("SELECT * FROM Categories");
        $sqlDataReader->execute();
//        $sqlDataReader->setFetchMode(\PDO::FETCH_ASSOC);

        $Categories = $sqlDataReader->fetchAll(\PDO::FETCH_ASSOC);
        return $Categories;
    }
    public function FindById($id){
        $con = Connection::getConnection();
        $sqlDataReader  = $con->prepare("SELECT * FROM Categories  WHERE id_ca = :id");
        $sqlDataReader->execute([':id' => $id]);

        $Categories = $sqlDataReader->fetch();
        if($Categories){
            $Categorie = new Categorie($Categories['Name'] ,$Categories['img'] );
            $Categorie->setId($Categories['id_ca']);
            return $Categorie->toObject();
        }else{
            return [];
        }
    }
    public function Save(Categorie $Categorie){
        $con = Connection::getConnection();
        $sqlDataReader  = $con->prepare("INSERT INTO Categories (Name , img) VALUES (:Name , :img)");
        $sqlDataReader->execute(
            [
                ':Name' => $Categorie->getName() ,
                ':img' => $Categorie->getImg() ,
            ]
        );
        return [
            "status" => true ,
            "message" => "Categorie Added Successfuly"
        ];
    }
    public function FindByIdAndUpdate(Categorie $Categorie){
        $con = Connection::getConnection();
        $sqlDataReader  = $con->prepare("UPDATE Categories SET Name=:Name , img=:img WHERE id_ca = :id ");

        if($sqlDataReader->execute(
            [
                ':id' => $Categorie->getId() ,
                ':Name' => $Categorie->getName() ,
                ':img' => $Categorie->getImg() ,
            ]
        )){
            return [
                "status" => true ,
                "message" => "Categorie Updated Successfuly"
            ];
        }else{
            return [
                "status" => true ,
                "message" => "Failed to Update Categorie"
            ];
        }

    }
    public function FindByIdAndDelete(Categorie $Categorie){
        $con = Connection::getConnection();
        $sqlDataReader  = $con->prepare("DELETE FROM Categories WHERE id_ca = :id");
        if(
        $sqlDataReader->execute([':id' => $Categorie->getId()])
        ){
            return [
                "status" => true ,
                "message" => "Categorie Deleted Successfuly"
            ];
        }
        else{
            return [
                "status" => true ,
                "message" => "Failed to Delete Categorie"
            ];
        }
    }
}