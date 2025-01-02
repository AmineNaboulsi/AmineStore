<?php

namespace App\Interface;

interface ClientPrivileges{
    
    public function Add_to_Panier() : void;
    public function Confirm_Panier() : void;
    public function Delete_from_Panier() : void;

}

?>
