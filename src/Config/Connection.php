<?php

namespace App\Config;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';

use App\Exceptions\DatabaseException;
use Dotenv\Dotenv;
use PDO;
class Connection{

    public static function getConnection() : \PDO|DatabaseException{
        $dotenv = Dotenv::createImmutable(realpath(__DIR__ . '/../../'));
        $dotenv->load();
        $HOST  = $_ENV['HOST'];
        $DBANME  = $_ENV['DATABASE'];
        $USER  = $_ENV['USER'];
        $PASSWORD  = $_ENV['PASSWORD'];
        $PORT  = $_ENV['PORT'];
        try{
            return new \PDO("mysql:host=$HOST;dbname=$DBANME;port=$PORT",$USER,$PASSWORD);
        }catch(DatabaseException $e){
            return $e;
        }
    }

}
?>