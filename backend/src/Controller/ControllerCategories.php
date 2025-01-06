<?php

namespace App\Controller;

use App\Models\Categorie;
use App\Repository\CategorieRepository;
class ControllerCategories
{

    public function Find(){
        $CategorieRepository = new CategorieRepository();
        if(isset($_GET['id'])){
            return $CategorieRepository->FindById($_GET['id']);
        }else{
            return  $CategorieRepository->Find();
        }
    }
    public function Save(){
        $parametres = ['name', 'img'];
        $findmissingpara = array_filter($parametres, function($para){
            return !isset($_POST[$para]);
        });
        if(!$findmissingpara){
            $CategorieRepository = new CategorieRepository();
            $Catergorie =new Categorie($_POST['name'] ,$_POST['img']);
            return $CategorieRepository->Save($Catergorie);
        }
        else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
    }
    public function UpdateCategorie(){
        $parametres = ['id','name', 'img'];
        $findmissingpara = array_filter($parametres, function($para){
            return !isset($_GET[$para]);
        });
        if(!$findmissingpara){
            $CategorieRepository = new CategorieRepository();
            $Catergorie =new Categorie($_GET['name'] ,$_GET['img']);
            $Catergorie->setId($_GET['id']);
            return  $CategorieRepository->FindByIdAndUpdate($Catergorie);
        }
        else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
    }
    public function DeleteCategorie(){

        if(isset($_GET['id'])){
            $CategorieRepository = new CategorieRepository();
            $Catergorie =new Categorie();
            $Catergorie->setId($_GET['id']);
            return $CategorieRepository->FindByIdAndDelete($Catergorie);
        }
        else{
            return [
                "status" => false ,
                "message" => "Missing parametres" ,
            ];
        }
    }

}