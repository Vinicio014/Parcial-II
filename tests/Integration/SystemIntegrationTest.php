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

	private OrderService $orderService;
    
    protected function setUp(): void
    {

        $this->orderService = new OrderService(new OrderRepository());	
    }

    public function testCompleteWorkflow(): void
    {
        // Crear orden
        $total = $laptop->getPrice() + $mouse->getPrice();
        $order = $this->orderService->createOrder($user->getId(), $total);
            
        $this->assertNotNull($order->getId());
        $this->assertEquals($user->getId(), $order->getUserId());
        $this->assertEquals($total, $order->getTotal());

        // Verificar que se pueden recuperar
        $retrievedUser = $this->userService->getUser($user->getId());
        $retrievedOrder = $this->orderService->getOrder($order->getId());
        
        $this->assertEquals($user->getName(), $retrievedUser->getName());
        $this->assertEquals($order->getTotal(), $retrievedOrder->getTotal());

    }

    public function testMultipleEntitiesCreation(): void
    {
    // Crear múltiples órdenes
        $order1 = $this->orderService->createOrder($user1->getId(), 100.00);
        $order2 = $this->orderService->createOrder($user2->getId(), 200.00);

    // Verificar totales
        $allOrders = $this->orderService->getAllOrders();

        $this->assertCount(2, $allOrders);
    }
}