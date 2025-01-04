<?php

namespace App\Middleware;

use App\Middleware\ValidationMiddleware;
class AuthMiddleware{

    public function handle(callable $nextAction)
    {
        if (!ValidationMiddleware::Verification()) {
            throw new Exception("Unauthorized access. Please log in.", 401);
        }
        return $nextAction();
    }
}

?>