<?php

namespace App\Models;
use App\Interface\AdminPrivileges;


class Admin implements AdminPrivileges{

    //Default cc
    public function __construct()
    {
        
    }
    public function ActiveAccount(INT $id_C) : void {

    }
    public function DeActiveAccount(INT $id_C) : void {
        
    }
}


?>