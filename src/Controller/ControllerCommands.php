<?php

namespace App\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\Command;
use App\Repository\CommandRepositiory;
require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';


class ControllerCommands{
    public function Find(){
        $CommandRepositiory = new CommandRepositiory();
        return $CommandRepositiory->Find(AuthMiddleware::getUserId());
    }
    public function Command(){
//        $parametres = ['id_p' , 'quantité'];
//        $missingpara = array_filter($parametres, function($parametre){
//            return !isset($_POST[$parametre]);
//        });
//        if(!$missingpara){
//            $CommandRepositiory = new CommandRepositiory();
//            $command = new Command($_POST['id_p'] , $_POST['quantité']);
//            //i think we dont need to handle dthe getuserId becaue of the middle ware validation
//            $command->setIdCa(AuthMiddleware::getUserId());
//            return $CommandRepositiory->CommandSave($command);
//        }else{
//            return [
//                "status" => false ,
//                "message" => "Missing parametres" ,
//            ];
//
//        }
        //it READS data from raw body wi can also use $HTTP_RAW_POST_DATA
        $input = file_get_contents("php://input");
        $data = json_decode($input);
        if (is_array($data)) {
            $Panier = array();
            foreach ($data as $row => $value ) {
                $command = new Command($value->id_p , $value->quantite);
                $command->setIdCa(AuthMiddleware::getUserId());
                $Panier[] = $command;
            }
            $CommandRepositiory = new CommandRepositiory();
            return $CommandRepositiory->CommandSave($Panier);

        } else {
            return [
                "status" => false ,
                "message" => "The given data was invalid.",
            ];
        }
    }
    public function DeleteCommand(){
        $input = file_get_contents("php://input");
        $data = json_decode($input);
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $CommandRepositiory = new CommandRepositiory();
            return $CommandRepositiory->DeleteCommand($_GET['id']);

        } else {
            return [
                "status" => false ,
                "message" => "Missing parameter.",
            ];
        }
    }
}

?>