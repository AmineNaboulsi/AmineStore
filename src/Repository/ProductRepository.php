<?php

namespace App\Repository;

use App\Config\Connection;
use App\Models\Product;

class ProductRepository{

    // Find product by ID
    public function findById(int $id) {
        $con = Connection::getConnection();
        $sqlDataReader =  $con->prepare("SELECT * FROM Products
         WHERE id_p=:id_p");

        $sqlDataReader->execute([
            ":id_p" => $id 
        ]);

        $Product = $sqlDataReader->fetchAll(\PDO::FETCH_ASSOC);
        if($Product){
            $ProductF = $Product[0];
            // var_dump($ProductF);
            $ProductFound = new Product(
                $ProductF['img'] ,
                $ProductF['name'],
                $ProductF['prix'],
                $ProductF['quantité']);

            $ProductFound->setDescription($ProductF['description']);
            $ProductFound->setId($ProductF['id_p']);
            $ProductFound->setProjected((bool)$ProductF['projected']);
            
            return $ProductFound->getObject();

       }else{
            return null;
       }
    }
    public function Find() {
        $con = Connection::getConnection();
        $sqlDataReader =  $con->prepare("SELECT * FROM Products");

        $sqlDataReader->execute();

        $Products = $sqlDataReader->fetchAll(\PDO::FETCH_ASSOC);
        return $Products;
       
    }
    // Save product to database
    public function Save(Product $product) {
        $con = Connection::getConnection();
        $sqlDataReader =  $con->prepare("INSERT INTO Products 
        (name , prix , description, quantité , projected ,img) Value 
        (:name , :price , :description, :stock , :projected ,:img)");

        if(
            $sqlDataReader->execute([
            ":name" => $product->getName() ,
            ":price" => $product->getPrice() ,
            ":description" => $product->getDescription() ,
            ":stock" =>$product->getStock() ,
            ":projected" => $product->isProjected()?1:0 ,
            ":img" =>$product->getImg() 
        ]) ) 
                return [
                    "status" => true ,
                    "message" => "Product Added Successfuly"
                ];
            else 
                return [
                    "status" => false ,
                    "message" => "Failed to add Product, Please try later"
                ];
    }

    // Update product from database
    public function findByIdAndUpdate(Product $product): array {
        $con = Connection::getConnection();
        $sqlDataReader =  $con->prepare("UPDATE Products 
        SET name=:name ,prix=:price,description=:description ,quantité=:stock ,projected=:projected ,img=:img 
        WHERE id_p=:id_p");

        if(
            $sqlDataReader->execute([
            ":id_p" => $product->getId() ,
            ":name" => $product->getName() ,
            ":price" => $product->getPrice() ,
            ":description" => $product->getDescription() ,
            ":stock" =>$product->getStock() ,
            ":projected" => $product->isProjected()?1:0 ,
            ":img" =>$product->getImg() 
        ]) ) 
            return [
                "status" => true ,
                "message" => "Product Updated on Successfuly"
            ];
            else 
            return [
                "status" => false ,
                "message" => "Failed to Updated Product, Please try later"
            ];
    }

    // Delete product from database
    public function findByIdAndDelete(Product $product): array {
        $con = Connection::getConnection();
        $sqlDataReader =  $con->prepare("DELETE FROM Products 
        WHERE id_p=:id_p");
        if(
            $sqlDataReader->execute([
            ":id_p" => $product->getId()
        ]) ) 
            return [
                "status" => true ,
                "message" => "Product Deleted Successfuly"
            ];
            else 
            return [
                "status" => false ,
                "message" => "Failed to Deleted Product, Please try later"
            ];
    }

    // Check Product stock is valid 
    public function isValidOnStock(int $IdProduct , int $NbPicked): bool {
        $con = Connection::getConnection();
        $sqlDataReader =  $con->prepare("SELECT quantité as stock FROM Products WHERE id_p=:id_p");
        $sqlDataReader->execute([
            ":id_p" => $IdProduct
        ]);
        $Product_Stock = $sqlDataReader->fetchAll(\PDO::FETCH_ASSOC);
        if ($Product_Stock && isset($productStock['stock'])) {
            return $productStock['stock'] >= $NbPicked;
        }else{
            //Now we need to handle in case of product , qantity didnt exists
            return false;
        }
    }

}

?>