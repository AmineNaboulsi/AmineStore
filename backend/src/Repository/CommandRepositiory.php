<?php

namespace App\Repository;

use App\Middleware\AuthMiddleware;
use App\Repository\ProductRepository;
use App\Models\Command;
use App\Config\Connection;

class CommandRepositiory
{

    public function Find(int $id){
        $con = Connection::getConnection();
        $sqlDataReaderC = $con->prepare("select  p.name , p.prix , c.quantité , c.Status from CommandDetails as c
            JOIN Products as p ON p.id_p = c.id_p
            WHERE id_c = :id");
        $sqlDataReaderC->execute([
            "id" => $id
        ]);
        return $sqlDataReaderC->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function CommandSave(array $command){
        try{
            $con = Connection::getConnection();
            $con->beginTransaction();
            $sqlDataReaderC = $con->prepare("INSERT INTO Commands  
                (date_c ) VALUES 
                (CURRENT_DATE) ");
            $sqlDataReaderC->execute();
            $IdCat = $con->lastInsertId();
            foreach ($command as $key => $value) {
            $ProductRepository = new ProductRepository();
                $sqlDataReader = $con->prepare("INSERT INTO CommandDetails 
                    (id_command ,id_c , id_p , quantité , Status) VALUES 
                    (:id_command , :id_c , :id_p , :quantite , :status ) ");
                if($ProductRepository->isValidOnStock($value->getIdP()  , $value->getQuantiter())){
                    $idCa = $value->getIdCa();
                    $idP = $value->getIdP();
                    $quantité = $value->getQuantiter();

                    $sqlDataReader->execute([
                        ":id_command" => $IdCat,
                        ":id_c" => $idCa,
                        ":id_p" => $idP,
                        ":quantite" => $quantité ,
                        ":status" => 0
                    ]);
                    $this->UpdateProjectStock($con , $value->getIdP() , $value->getQuantiter());
                
                }
                    else {
                        $ProductRepository = new ProductRepository();
                        $Product  = $ProductRepository->findById($value->getIdP());
                        $ProductName = $Product!=null ? $Product['name'] : "xxxxx" ;
                        $con->rollBack();
                        return [
                            "status" => false,
                            "message" => "Invalid Stock ".$value->getQuantiter()." on the " . $ProductName . " product "
                        ];
                    }
                }
                $con->commit();
            return [
                "status" => true,
                "message" => "Command saved"
            ];
        }catch (\PDOException $e){
            $con->rollBack();
            return [
                "status" => false,
                "message" => "Failed to save command " .$e->getMessage()
            ];
        }
    }
    public function DeleteCommand(int $id){
        $con = Connection::getConnection();
        $sqlDataReaderC = $con->prepare("DELETE FROM Commands 
            WHERE id_c = :id");
        $sqlDataReaderC->execute([
            "id" => $id
        ]);
        return [
            "status" => true,
            "message" => "Command deleted"
        ];
    }


    public function UpdateProjectStock($con , $productid , $qantiter): bool {

            $sqlDataReader =  $con->prepare("UPDATE Products 
        SET quantité = quantité - :quantite  
        WHERE id_p=:id_p");
        if(
            $sqlDataReader->execute([
                ":quantite" => $qantiter,
                ":id_p" => $productid 
                ]) )
                {
                    return true;
                    
                } 
                else{
                    return false;
                }
           
    }
}