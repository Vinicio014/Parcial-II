<?php

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepository;
use App\Entities\Interfaces\UserInterface;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(string $name, string $email): UserInterface
    {
        $user = new User($name, $email);
        return $this->userRepository->save($user);
    }

    public function getUser(int $id): ?UserInterface
    {
        return $this->userRepository->findById($id);
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }
}