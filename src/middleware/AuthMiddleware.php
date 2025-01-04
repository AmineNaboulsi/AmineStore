<?php

namespace App\Middleware;

class AuthMiddleware{

    public static function handle(callable $nextAction)
    {
        if (ValidationMiddleware::Verification()==-1) {
            return [
                "status" => false,
                "message" => "Unauthorized access. Please log in."
            ];
        }else if (ValidationMiddleware::Verification()==-2) {
            return [
                "status" => false,
                "message" => "Token Expired. Please log in."
            ];
        }else if (ValidationMiddleware::Verification()==-3) {
            return [
                "status" => false,
                "message" => "Unauthorization failed. Please log in."
            ];
        }
        return $nextAction();
    }
}

?>