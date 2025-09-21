<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use App\Services\UserService;
use App\Services\ProductService;
use App\Services\OrderService;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\OrderRepository;

class SystemIntegrationTest extends TestCase
{
    private UserService $userService;
    private ProductService $productService;
    private OrderService $orderService;

    protected function setUp(): void
    {
        $this->userService    = new UserService(new UserRepository());
        $this->productService = new ProductService(new ProductRepository());
        $this->orderService   = new OrderService(new OrderRepository());
    }

    public function testCompleteWorkflow(): void
    {
        // Crear usuario
        $user = $this->userService->createUser('John Doe', 'john@example.com');
        $this->assertNotNull($user->getId());
        $this->assertEquals('John Doe', $user->getName());

        // Producto
        $laptop = $this->productService->createProduct('Laptop', 1500.00);
        $mouse  = $this->productService->createProduct('Mouse', 25.00);
        $this->assertNotNull($laptop->getId());
        $this->assertNotNull($mouse->getId());

        // Crear orden con el total de los productos
        $total = $laptop->getPrice() + $mouse->getPrice();
        $order = $this->orderService->createOrder($user->getId(), $total);

        $this->assertNotNull($order->getId());
        $this->assertEquals($user->getId(), $order->getUserId());
        $this->assertEquals($total, $order->getTotal());

        // Verificar recuperación
        $retrievedUser  = $this->userService->getUser($user->getId());
        $retrievedOrder = $this->orderService->getOrder($order->getId());

        $this->assertEquals($user->getName(), $retrievedUser->getName());
        $this->assertEquals($order->getTotal(), $retrievedOrder->getTotal());
    }

    public function testMultipleEntitiesCreation(): void
    {
        // Crear múltiples usuarios
        $user1 = $this->userService->createUser('User 1', 'user1@example.com');
        $user2 = $this->userService->createUser('User 2', 'user2@example.com');

        // === TU PARTE: múltiples productos ===
        $product1 = $this->productService->createProduct('Product 1', 100.00);
        $product2 = $this->productService->createProduct('Product 2', 200.00);
        $this->assertNotNull($product1->getId());
        $this->assertNotNull($product2->getId());

        // Crear múltiples órdenes
        $order1 = $this->orderService->createOrder($user1->getId(), 100.00);
        $order2 = $this->orderService->createOrder($user2->getId(), 200.00);

        // Verificar totales/contadores
        $allUsers    = $this->userService->getAllUsers();
        $allProducts = $this->productService->getAllProducts();
        $allOrders   = $this->orderService->getAllOrders();

        $this->assertCount(2, $allUsers);
        $this->assertCount(2, $allProducts);
        $this->assertCount(2, $allOrders);
    }
}
