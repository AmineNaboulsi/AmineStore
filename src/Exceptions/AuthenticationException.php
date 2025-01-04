<?php

class AuthenticationException extends Exception{

    public function Message() {
        return 'Authetication Failed';  
    }
}

?>