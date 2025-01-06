<?php
namespace App\Middleware;

use App\Config\JwtUtil;
class RoleMiddleware{

    public static function GetRole(){
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            list($type, $data) = explode(" ", $_SERVER["HTTP_AUTHORIZATION"], 2);
            if (strcasecmp($type, "Bearer") == 0) {
                $role = JwtUtil::getRole($data);
                return $role;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}
?>