<?php

namespace App\Controller;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';

use App\Models\Product;
use App\Repository\ProductRepository;

class ControllerProduct{

    public function __construct()
    {
        
    }
    public function Find()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $ProductRepository =new ProductRepository();
            $Product = $ProductRepository->findById($_GET['id']);
            return $Product;
        }else{
            $ProductRepository =new ProductRepository();
            $Products = $ProductRepository->Find();
            return $Products;
        }
    }
    public function Save()
    {
        $parametres = ['name' , 'price' , 'stock','img'];
        $findmissingpara = array_filter($parametres , function($para){
            return !isset($_POST[$para]);
        });
        if(!$findmissingpara){

            $ProductRepository =new ProductRepository();
            $NewProduct =new Product(
                $_POST["img"] ,
                $_POST["name"] ,
                $_POST["price"] ,
                $_POST["stock"]);
            $NewProduct->setDescription(isset($_POST["description"]) ? $_POST["description"] : "");
            $NewProduct->setProjected(isset($_POST["projected"]) ? (bool)$_POST["projected"] : 1);
            return $ProductRepository->Save($NewProduct);
        }else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
        
    }
    public function UpdateProduct()
    {
        $parametres = ['name' , 'price' , 'stock','img'];
        $findmissingpara = array_filter($parametres , function($para){
            return !isset($_POST[$para]);
        });
        if(!$findmissingpara){

            $ProductRepository =new ProductRepository();
            $NewProduct =new Product(
                $_POST["img"] ,
                $_POST["name"] ,
                $_POST["price"] ,
                $_POST["stock"]);
            $NewProduct->setDescription(isset($_POST["description"]) ? $_POST["description"] : "");
            $NewProduct->setProjected(isset($_POST["projected"]) ? (bool)$_POST["projected"] : 1);
            return $ProductRepository->Save($NewProduct);
        }else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
        $ProductRepository =new ProductRepository();
        
    }
    public function DelProduct()
    {
        $ProductRepository =new ProductRepository();
        
    }

}



?>