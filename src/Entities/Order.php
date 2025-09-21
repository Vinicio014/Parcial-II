<?php

namespace App\Entities;

use App\Entities\Interfaces\OrderInterface;

class Order implements OrderInterface
{
    private ?int $id = null;
    private int $userId;
    private float $total;

    public function __construct(int $userId = 0, float $total = 0.0)
    {
        $this->userId = $userId;
        $this->total = $total;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'total' => $this->total
        ];
    }
}