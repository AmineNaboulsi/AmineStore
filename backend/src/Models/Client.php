<?php

namespace App\Models;

require realpath(
    __DIR__ . '/../../'
) . '/vendor/autoload.php';


use App\Interface\ClientPrivileges;
use App\Config\Connection;
use App\Config\JwtUtil;
use App\Models\User;


class Client extends User /* implements ClientPrivileges */ {

    public bool $Active;
    public array $Panier ;
    public function __construct($name="" , $email="" , $password="")
    {
        parent::__construct($name , $email , $password);
    }
    public function toObject()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'Active' => $this->Active
        ];
    }
}

?>