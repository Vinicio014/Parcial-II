<?php

namespace Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\Order;

class OrderTest extends TestCase
{
    private Order $order;

    protected function setUp(): void
    {
        $this->order = new Order(123, 999.99);
    }

    public function testConstructorSetsUserIdAndTotal(): void
    {
        $this->assertEquals(123, $this->order->getUserId());
        $this->assertEquals(999.99, $this->order->getTotal());
        $this->assertNull($this->order->getId());
    }

    public function testSetAndGetId(): void
    {
        $this->order->setId(456);
        $this->assertEquals(456, $this->order->getId());
    }

    public function testSetAndGetUserId(): void
    {
        $this->order->setUserId(789);
        $this->assertEquals(789, $this->order->getUserId());
    }

    public function testSetAndGetTotal(): void
    {
        $this->order->setTotal(1234.56);
        $this->assertEquals(1234.56, $this->order->getTotal());
    }

    public function testToArrayReturnsCorrectFormat(): void
    {
        $this->order->setId(202);
        $expected = [
            'id' => 202,
            'userId' => 123,
            'total' => 999.99
        ];
        
        $this->assertEquals($expected, $this->order->toArray());
    }

    public function testZeroTotalIsValid(): void
    {
        $freeOrder = new Order(1, 0.0);
        $this->assertEquals(0.0, $freeOrder->getTotal());
    }

    public function testEmptyConstructor(): void
    {
        $emptyOrder = new Order();
        $this->assertEquals(0, $emptyOrder->getUserId());
        $this->assertEquals(0.0, $emptyOrder->getTotal());
    }
}