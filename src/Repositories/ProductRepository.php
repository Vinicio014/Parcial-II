<?php

namespace App\Repositories;

use App\Entities\Interfaces\ProductInterface;

class ProductRepository
{
    /** @var array<int,ProductInterface> */
    private array $products = [];
    private int $autoIncrement = 1;

    public function save(ProductInterface $product): ProductInterface
    {
        if ($product->getId() === null) {
            $product->setId($this->autoIncrement++);
        }
        $this->products[$product->getId()] = $product;
        return $product;
    }

    public function findById(int $id): ?ProductInterface
    {
        return $this->products[$id] ?? null;
    }

    /** @return ProductInterface[] */
    public function findAll(): array
    {
        return array_values($this->products);
    }
}
