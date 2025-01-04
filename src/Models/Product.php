<?php

namespace App\Models;

class Product{
    
    /* Attribute declaration */
    private int $id_p;
    private string $name;
    private float $price;
    private string $description;
    private int $stock;
    private bool $projected;
    private string $img;

    /* Constrecteur declaration */
    public function __construct($img , $name , $price , $stock )
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->img = $img;
    }

    /* accesseur declaration */
    public function getId(): string { return $this->id_p; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }
    public function getStock(): int { return $this->stock; }
    public function getImg(): string { return $this->img; }
    public function isProjected(): int { return $this->projected; }
    
    public function setId(int $id_p) : void {$this->id_p = $id_p;}
    public function setDescription(string $description) : void { $this->description = $description;}
    public function setProjected(bool $isProjected) : void { $this->projected = $isProjected;}
    
    public function Edit_Product() : void {
        
    }
    public function Del_Product() : void {
        
    }
    public function Save_Product() : void {
        
    }


    public function getObject()
    {
        return [
           'id_p' => $this->id_p,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'stock' => $this->stock,
            'projected' => $this->projected,
            'img' => $this->img
        ];
    }

}