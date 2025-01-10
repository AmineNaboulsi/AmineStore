<?php

namespace App\Controller;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';

use App\Models\Product;
use App\Repository\ProductRepository;

class ControllerProduct{

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
        $parametres = ['name' , 'price' , 'stock','img','cd_id'];
        $findmissingpara = array_filter($parametres , function($para){
            return !isset($_POST[$para]);
        });
        if(!$findmissingpara){

            $ProductRepository =new ProductRepository();
            $NewProduct =new Product(
                $_POST["img"] ,
                $_POST["name"] ,
                $_POST["price"] ,
                $_POST["stock"] , $_POST["cd_id"]);
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
        $parametres = ['id','name' , 'price' , 'stock','img'];
        $findmissingpara = array_filter($parametres , function($para){
            return !isset($_GET[$para]);
        });
        if(!$findmissingpara){
            $ProductRepository =new ProductRepository();
            $NewProduct =new Product(
                $_GET["img"] ,
                $_GET["name"] ,
                $_GET["price"] ,
                $_GET["stock"]);
            $NewProduct->setId($_GET['id']);
            $NewProduct->setDescription(isset($_GET["description"]) ? $_GET["description"] : "");
            $NewProduct->setProjected(isset($_GET["projected"]) ? (bool)$_GET["projected"] : 1);
            return $ProductRepository->findByIdAndUpdate($NewProduct);
        }else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
    }
    public function ProjectProduct()
    {
        $parametres = ['id','projected'];
        $findmissingpara = array_filter($parametres , function($para){
            return !isset($_GET[$para]);
        });
        if(!$findmissingpara){
            $ProductRepository =new ProductRepository();
            $NewProduct =new Product();
            $NewProduct->setId($_GET['id']);
            $NewProduct->setProjected(isset($_GET["projected"]) ? (bool)$_GET["projected"] : 1);
            return $ProductRepository->findByIdAndUpdateProject($NewProduct);
        }else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
    }
    public function DelProduct()
    {
        $parametres = ['id'];
        $findmissingpara = array_filter($parametres , function($para){
            return !isset($_GET[$para]);
        });
        if(!$findmissingpara){
            $ProductRepository =new ProductRepository();
            $NewProduct =new Product();
            $NewProduct->setId($_GET['id']);
            return $ProductRepository->findByIdAndDelete($NewProduct);
        }else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
    }

}



?>