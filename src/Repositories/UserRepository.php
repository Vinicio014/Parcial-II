<?php

namespace App\Repositories;

use App\Entities\User;
use App\Entities\Interfaces\UserInterface;

class UserRepository
{
    private array $users = [];
    private int $nextId = 1;

    public function save(UserInterface $user): UserInterface
    {
        if ($user->getId() === null) {
            $user->setId($this->nextId++);
        }
        $this->users[$user->getId()] = $user;
        return $user;
    }

    public function findById(int $id): ?UserInterface
    {
        return $this->users[$id] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->users);
    }
}