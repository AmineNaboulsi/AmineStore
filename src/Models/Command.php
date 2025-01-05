<?php

namespace App\Models;


class Command{

    public int $id_ca;
    public int $id_p;
    public int $quantiter;
    public int $Status;

    public function __construct(int $id_p , int $quantiter)
    {
        $this->id_p = $id_p;
        $this->quantiter = $quantiter;
    }

    public function getIdCa(): int
    {
        return $this->id_ca;
    }

    public function setIdCa(int $id_ca): void
    {
        $this->id_ca = $id_ca;
    }

    public function getStatus(): int
    {
        return $this->Status;
    }

    public function setStatus(int $Status): void
    {
        $this->Status = $Status;
    }

    public function getIdP(): int
    {
        return $this->id_p;
    }

    public function setIdP(int $id_p): void
    {
        $this->id_p = $id_p;
    }

    public function getQuantiter(): int
    {
        return $this->quantiter;
    }

    public function setQuantiter(int $quantiter): void
    {
        $this->quantiter = $quantiter;
    }



}


?>