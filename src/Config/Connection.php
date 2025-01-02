<?php

namespace App\Config;
require realpath(__DIR__ . '/../') . '/vendor/autoload.php';

use App\Exceptions\PDOconException;
use Dotenv\Dotenv;

class Connection{

    public static function getConnection() : \PDO|PDOconException{
        $dotenv = Dotenv::createImmutable(realpath(__DIR__ . '/../'));
        $dotenv->load();
        $HOST  = $_ENV['HOST'];
        $DBANME  = $_ENV['DBANME'];
        $USER  = $_ENV['USER'];
        $PASSWORD  = $_ENV['PASSWORD'];
        $PORT  = $_ENV['PORT'];
        try{
            return new \PDO("mysql:host=$HOST;dbname=$DBANME;port=$PORT",$USER,$PASSWORD);
        }catch(PDOconException $e){
            return $e;
        }
    }

}
?>