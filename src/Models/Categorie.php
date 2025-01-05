<?php

namespace App\Models;


class Categorie{
    private int $id;
    private string $name;
    private string $img;


    public function __construct(string $name="", string $img="")
    {
        $this->name = $name;
        $this->img = $img;
    }


    public function getId(): int { return $this->id;}

    public function setId(int $id): void{$this->id = $id;}

    public function getName(): string { return $this->name;}

    public function setName(string $name): void{$this->name = $name;}

    public function getImg(): string{return $this->img;    }

    public function setImg(string $img): void{$this->img = $img;    }

    public function toObject()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'img' => $this->img
        ];
    }
}

?>