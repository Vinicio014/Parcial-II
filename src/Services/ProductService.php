<?php

namespace App\Services;

use App\Entities\Product;
use App\Repositories\ProductRepository;
use App\Entities\Interfaces\ProductInterface;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(string $name, float $price): ProductInterface
    {
        $product = new Product($name, $price);
        return $this->productRepository->save($product);
    }

    public function getProduct(int $id): ?ProductInterface
    {
        return $this->productRepository->findById($id);
    }

    /** @return ProductInterface[] */
    public function getAllProducts(): array
    {
        return $this->productRepository->findAll();
    }
}
