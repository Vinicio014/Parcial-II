<?php

namespace Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use App\Entities\User;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User('John Doe', 'john@example.com');
    }

    public function testConstructorSetsNameAndEmail(): void
    {
        $this->assertEquals('John Doe', $this->user->getName());
        $this->assertEquals('john@example.com', $this->user->getEmail());
        $this->assertNull($this->user->getId());
    }

    public function testSetAndGetId(): void
    {
        $this->user->setId(123);
        $this->assertEquals(123, $this->user->getId());
    }

    public function testSetAndGetName(): void
    {
        $this->user->setName('Jane Smith');
        $this->assertEquals('Jane Smith', $this->user->getName());
    }

    public function testSetAndGetEmail(): void
    {
        $this->user->setEmail('jane@example.com');
        $this->assertEquals('jane@example.com', $this->user->getEmail());
    }

    public function testToArrayReturnsCorrectFormat(): void
    {
        $this->user->setId(456);
        $expected = [
            'id' => 456,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
        
        $this->assertEquals($expected, $this->user->toArray());
    }

    public function testToArrayWithNullId(): void
    {
        $expected = [
            'id' => null,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
        
        $this->assertEquals($expected, $this->user->toArray());
    }

    public function testEmptyConstructor(): void
    {
        $emptyUser = new User();
        $this->assertEquals('', $emptyUser->getName());
        $this->assertEquals('', $emptyUser->getEmail());
    }
}