<?php

namespace App\Entities\Interfaces;

interface OrderInterface
{
    public function getId(): ?int;
    public function setId(int $id): void;
    public function getUserId(): int;
    public function setUserId(int $userId): void;
    public function getTotal(): float;
    public function setTotal(float $total): void;
    public function toArray(): array;
}