<?php

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $user): User;

    public function update(User $user): void;

    public function delete(User $user): void;

    public function getById(int $id): ?User;

    public function getByEmail(string $email): ?User;
}
