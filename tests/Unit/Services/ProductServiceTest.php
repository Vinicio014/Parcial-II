ProductServiceTest.php
php<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Entities\Product;

class ProductServiceTest extends TestCase
{
    private ProductService $productService;
    private MockObject $mockRepository;

    protected function setUp(): void
    {
        $this->mockRepository = $this->createMock(ProductRepository::class);
        $this->productService = new ProductService($this->mockRepository);
    }

    public function testCreateProductCallsRepositorySave(): void
    {
        $expectedProduct = new Product('Laptop', 1500.00);
        $expectedProduct->setId(1);

        $this->mockRepository
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($product) {
                return $product instanceof Product && 
                       $product->getName() === 'Laptop' && 
                       $product->getPrice() === 1500.00;
            }))
            ->willReturn($expectedProduct);

        $result = $this->productService->createProduct('Laptop', 1500.00);

        $this->assertEquals($expectedProduct, $result);
    }

    public function testGetProductCallsRepositoryFindById(): void
    {
        $expectedProduct = new Product('Laptop', 1500.00);
        $expectedProduct->setId(1);

        $this->mockRepository
            ->expects($this->once())
            ->method('findById')
            ->with(1)
            ->willReturn($expectedProduct);

        $result = $this->productService->getProduct(1);

        $this->assertEquals($expectedProduct, $result);
    }

    public function testGetAllProductsCallsRepositoryFindAll(): void
    {
        $product1 = new Product('Laptop', 1500.00);
        $product2 = new Product('Mouse', 25.00);
        $expectedProducts = [$product1, $product2];

        $this->mockRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($expectedProducts);

        $result = $this->productService->getAllProducts();

        $this->assertEquals($expectedProducts, $result);
        $this->assertCount(2, $result);
    }
}