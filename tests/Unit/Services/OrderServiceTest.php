<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\Services\OrderService;
use App\Repositories\OrderRepository;
use App\Entities\Order;

class OrderServiceTest extends TestCase
{
    private OrderService $orderService;
    private MockObject $mockRepository;

    protected function setUp(): void
    {
        $this->mockRepository = $this->createMock(OrderRepository::class);
        $this->orderService = new OrderService($this->mockRepository);
    }

    public function testCreateOrderCallsRepositorySave(): void
    {
        $expectedOrder = new Order(1, 1525.00);
        $expectedOrder->setId(1);

        $this->mockRepository
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($order) {
                return $order instanceof Order && 
                       $order->getUserId() === 1 && 
                       $order->getTotal() === 1525.00;
            }))
            ->willReturn($expectedOrder);

        $result = $this->orderService->createOrder(1, 1525.00);

        $this->assertEquals($expectedOrder, $result);
    }

    public function testGetOrderCallsRepositoryFindById(): void
    {
        $expectedOrder = new Order(1, 1525.00);
        $expectedOrder->setId(1);

        $this->mockRepository
            ->expects($this->once())
            ->method('findById')
            ->with(1)
            ->willReturn($expectedOrder);

        $result = $this->orderService->getOrder(1);

        $this->assertEquals($expectedOrder, $result);
    }

    public function testGetAllOrdersCallsRepositoryFindAll(): void
    {
        $order1 = new Order(1, 100.00);
        $order2 = new Order(2, 200.00);
        $expectedOrders = [$order1, $order2];

        $this->mockRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($expectedOrders);

        $result = $this->orderService->getAllOrders();

        $this->assertEquals($expectedOrders, $result);
        $this->assertCount(2, $result);
    }
}