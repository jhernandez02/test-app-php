<?php

use PHPUnit\Framework\TestCase;
use App\Domain\User\User;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User('Bruce Wayne', 'bruce@wayne.com', 'password123');
        $this->assertEquals('Bruce Wayne', $user->getName());
        $this->assertEquals('bruce@wayne.com', $user->getEmail());
    }

    public function testPasswordVerification(): void
    {
        $user = new User('John Titor', 'john@mail.com', 'password123');
        $this->assertTrue($user->verifyPassword('password123'));
        $this->assertFalse($user->verifyPassword('wrongpassword'));
    }
}
