<?php
//pruebas
namespace App\Entities\Interfaces;

interface ProductInterface
{
    public function getId(): ?int;
    public function setId(int $id): void;
    public function getName(): string;
    public function setName(string $name): void;
    public function getPrice(): float;
    public function setPrice(float $price): void;
    public function toArray(): array;
}
