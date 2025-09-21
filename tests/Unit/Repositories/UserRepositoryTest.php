<?php

namespace Tests\Unit\Repositories;

use PHPUnit\Framework\TestCase;
use App\Repositories\UserRepository;
use App\Entities\User;

class UserRepositoryTest extends TestCase
{
    private UserRepository $repository;
    private User $user;

    protected function setUp(): void
    {
        $this->repository = new UserRepository();
        $this->user = new User('Test User', 'test@example.com');
    }

    public function testSaveAssignsIdToNewUser(): void
    {
        $savedUser = $this->repository->save($this->user);
        
        $this->assertNotNull($savedUser->getId());
        $this->assertEquals(1, $savedUser->getId());
        $this->assertEquals('Test User', $savedUser->getName());
    }

    public function testSaveIncrementIdForMultipleUsers(): void
    {
        $user1 = new User('User 1', 'user1@example.com');
        $user2 = new User('User 2', 'user2@example.com');
        
        $savedUser1 = $this->repository->save($user1);
        $savedUser2 = $this->repository->save($user2);
        
        $this->assertEquals(1, $savedUser1->getId());
        $this->assertEquals(2, $savedUser2->getId());
    }

    public function testSaveDoesNotChangeExistingId(): void
    {
        $this->user->setId(99);
        $savedUser = $this->repository->save($this->user);
        
        $this->assertEquals(99, $savedUser->getId());
    }

    public function testFindByIdReturnsCorrectUser(): void
    {
        $savedUser = $this->repository->save($this->user);
        $foundUser = $this->repository->findById($savedUser->getId());
        
        $this->assertNotNull($foundUser);
        $this->assertEquals($savedUser->getId(), $foundUser->getId());
        $this->assertEquals('Test User', $foundUser->getName());
    }

    public function testFindByIdReturnsNullForNonExistentId(): void
    {
        $foundUser = $this->repository->findById(999);
        $this->assertNull($foundUser);
    }

    public function testFindAllReturnsEmptyArrayInitially(): void
    {
        $users = $this->repository->findAll();
        $this->assertIsArray($users);
        $this->assertCount(0, $users);
    }

    public function testFindAllReturnsAllSavedUsers(): void
    {
        $user1 = new User('User 1', 'user1@example.com');
        $user2 = new User('User 2', 'user2@example.com');
        
        $this->repository->save($user1);
        $this->repository->save($user2);
        
        $users = $this->repository->findAll();
        $this->assertCount(2, $users);
    }
}