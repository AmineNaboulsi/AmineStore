<?php

namespace App\Middleware;

use App\Middleware\RoleMiddleware;
class AuthMiddleware{

    public static function handle($isAdmin,callable $nextAction)
    {
        if (ValidationMiddleware::Verification()==-1) {
            http_response_code(401);
            return [
                "status" => false,
                "message" => "Unauthorized access. Please log in."
            ];
        }else if (ValidationMiddleware::Verification()==-2) {
            http_response_code(401);
            return [
                "status" => false,
                "message" => "Token Expired. Please log in."
            ];
        }else if (ValidationMiddleware::Verification()==-3) {
            http_response_code(401);
            return [
                "status" => false,
                "message" => "Unauthorization failed. Please log in."
            ];
        }
        if($isAdmin)
        {
            if(strcasecmp(RoleMiddleware::GetRole(),"admin")!=0){
                return [
                "status" => false,
                "message" => "No Permission to make this operation."
                ];
            }

        }
        return $nextAction();
    }
    public static function getUserId()
    {
        return ValidationMiddleware::Verification();
    }

}

?>