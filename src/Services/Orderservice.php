<?php

namespace App\Services;

use App\Entities\Order;
use App\Repositories\OrderRepository;
use App\Entities\Interfaces\OrderInterface;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(int $userId, float $total): OrderInterface
    {
        $order = new Order($userId, $total);
        return $this->orderRepository->save($order);
    }

    public function getOrder(int $id): ?OrderInterface
    {
        return $this->orderRepository->findById($id);
    }

    public function getAllOrders(): array
    {
        return $this->orderRepository->findAll();
    }
}