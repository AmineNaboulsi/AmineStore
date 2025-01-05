<?php

namespace App\Controller;

class ControllerCategories
{
    private int $id;
    private string $name;
    private string $img;


    public function __construct(int $id, string $name, string $img)
    {
        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
    }


    public function getId(): int { return $this->id;}

    public function setId(int $id): void{$this->id = $id;}

    public function getName(): string { return $this->name;}

    public function setName(string $name): void{$this->name = $name;}

    public function getImg(): string{return $this->img;    }

    public function setImg(string $img): void{$this->img = $img;    }


}