<?php

namespace App\Entities\Interfaces;

interface UserInterface
{
    public function getId(): ?int;
    public function setId(int $id): void;
    public function getName(): string;
    public function setName(string $name): void;
    public function getEmail(): string;
    public function setEmail(string $email): void;
    public function toArray(): array;
}