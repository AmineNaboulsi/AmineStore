<?php
namespace App\Middleware;

use Closure;
use App\Config\JwtUtil;

class ValidationMiddleware{
    public static function Verification(){
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            list($type, $data) = explode(" ", $_SERVER["HTTP_AUTHORIZATION"], 2);
            if (strcasecmp($type, "Bearer") == 0) {
                $id = JwtUtil::ValidToken($data);
                return $id;
            }else{
                return -1;
            }
        }else{
            return -1;
        }
    }


}



?>