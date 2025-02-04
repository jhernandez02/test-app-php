<?php

namespace App\Infrastructure\Persistence;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function save(User $user): User
    {
        if ($user->getId() === null) {
            $user = new User($user->getName(), $user->getEmail(), $user->getPassword(), count($this->users) + 1);
        }
        $this->users[$user->getId()] = $user;
        return $user;
    }

    public function update(User $user): void
    {
        if ($user->getId() === null || !isset($this->users[$user->getId()])) {
            throw new \InvalidArgumentException("User not found.");
        }
        $this->users[$user->getId()] = $user;
    }

    public function delete(User $user): void
    {
        if ($user->getId() === null || !isset($this->users[$user->getId()])) {
            throw new \InvalidArgumentException("User not found.");
        }
        unset($this->users[$user->getId()]);
    }

    public function getById(int $id): ?User
    {
        return $this->users[$id] ?? null;
    }

    public function getByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }
}
