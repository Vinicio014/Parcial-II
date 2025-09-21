<?php

namespace Tests\Unit\Repositories;

use PHPUnit\Framework\TestCase;
use App\Repositories\OrderRepository;
use App\Entities\Order;

class OrderRepositoryTest extends TestCase
{
    private OrderRepository $repository;
    private Order $order;

    protected function setUp(): void
    {
        $this->repository = new OrderRepository();
        $this->order = new Order(1, 150.75);
    }

    public function testSaveAssignsIdToNewOrder(): void
    {
        $savedOrder = $this->repository->save($this->order);
        
        $this->assertNotNull($savedOrder->getId());
        $this->assertEquals(1, $savedOrder->getId());
        $this->assertEquals(1, $savedOrder->getUserId());
        $this->assertEquals(150.75, $savedOrder->getTotal());
    }

    public function testSaveIncrementIdForMultipleOrders(): void
    {
        $order1 = new Order(1, 100.00);
        $order2 = new Order(2, 200.00);
        
        $savedOrder1 = $this->repository->save($order1);
        $savedOrder2 = $this->repository->save($order2);
        
        $this->assertEquals(1, $savedOrder1->getId());
        $this->assertEquals(2, $savedOrder2->getId());
    }

    public function testFindByIdReturnsCorrectOrder(): void
    {
        $savedOrder = $this->repository->save($this->order);
        $foundOrder = $this->repository->findById($savedOrder->getId());
        
        $this->assertNotNull($foundOrder);
        $this->assertEquals($savedOrder->getId(), $foundOrder->getId());
        $this->assertEquals(1, $foundOrder->getUserId());
        $this->assertEquals(150.75, $foundOrder->getTotal());
    }

    public function testFindByIdReturnsNullForNonExistentId(): void
    {
        $foundOrder = $this->repository->findById(999);
        $this->assertNull($foundOrder);
    }

    public function testFindAllReturnsAllSavedOrders(): void
    {
        $order1 = new Order(1, 100.00);
        $order2 = new Order(2, 200.00);
        
        $this->repository->save($order1);
        $this->repository->save($order2);
        
        $orders = $this->repository->findAll();
        $this->assertCount(2, $orders);
    }
}