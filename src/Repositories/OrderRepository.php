<?php

namespace App\Repositories;

use App\Entities\Order;
use App\Entities\Interfaces\OrderInterface;

class OrderRepository
{
    private array $orders = [];
    private int $nextId = 1;

    public function save(OrderInterface $order): OrderInterface
    {
        if ($order->getId() === null) {
            $order->setId($this->nextId++);
        }
        $this->orders[$order->getId()] = $order;
        return $order;
    }

    public function findById(int $id): ?OrderInterface
    {
        return $this->orders[$id] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->orders);
    }
}