<?php

namespace App\Application\UseCases;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\DTO\SaveUserRequest;

class SaveUserUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(SaveUserRequest $request): User
    {
        // Verificar si el correo ya está registrado
        if ($this->userRepository->getByEmail($request->email)) {
            throw new \Exception("Email is already in use.");
        }

        $user = new User($request->name, $request->email, $request->password);
        $result = $this->userRepository->save($user);

        return $result;
    }
}
