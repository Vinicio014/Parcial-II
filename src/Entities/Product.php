<?php

namespace App\Entities;

use App\Entities\Interfaces\ProductInterface;

class Product implements ProductInterface
{
    private ?int $id = null;
    private string $name;
    private float $price;

    public function __construct(string $name = '', float $price = 0.0)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getPrice(): float { return $this->price; }
    public function setPrice(float $price): void { $this->price = $price; }

    public function toArray(): array
    {
        return ['id'=>$this->id, 'name'=>$this->name, 'price'=>$this->price];
    }
}
