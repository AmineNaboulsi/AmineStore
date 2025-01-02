<?php

namespace App\Config;

define('One_DAY', 86400);
define('One_WEEK', 7 * 86400);
define('One_MONTH', 30 * 86400);
define('One_YEAR', 365 * 86400);


use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;
use App\Models\User;

class JwtUtil {

    public static function generateToken(User $User)  {
        $dotenv = Dotenv::createImmutable(realpath(__DIR__ . '/../../'));
        $dotenv->load();

        $secretKey = $_ENV['SECRETKEY'];
        $algorithm = "HS256";

        $payload = [
            'iat' => time(),
            'exp' => time() + One_DAY,
            'id' => $User->id
        ];
        return JWT::encode($payload, $secretKey, $algorithm);
    }
    
}

?>
