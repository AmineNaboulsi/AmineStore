<?php
namespace App\Middleware;

use Closure;

class ValidationMiddleware{
    public static function Verification(){
        if(isset($_COOKIE['auth_tk'])){
//            $_COOKIE['auth_tk'] = $request->getCookieParams();

        }else{
            return false;
        }
    }
}



?>