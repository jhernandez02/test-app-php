<?php

use PHPUnit\Framework\TestCase;
use App\Application\UseCases\SaveUserUseCase;
use App\Domain\User\User;
use App\Infrastructure\Persistence\UserRepository;
use App\DTO\SaveUserRequest;

class SaveUserUseCaseTest extends TestCase
{
    private SaveUserUseCase $useCase;
    private UserRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new UserRepository();
        $this->useCase = new SaveUserUseCase($this->repository);
    }

    public function testUserCanBeSaved(): void
    {
        $request = new SaveUserRequest('Bart Simpson', 'bsimpson@mail.com', 'password123');
        $user = $this->useCase->execute($request);

        $this->assertNotNull($user->getId());
        $this->assertEquals('Bart Simpson', $user->getName());
    }

    public function testEmailAlreadyInUse(): void
    {
        $this->repository->save(new User('Bart Simpson', 'bsimpson@mail.com', 'password123'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Email is already in use.');

        $request = new SaveUserRequest('Berny Simpson', 'bsimpson@mail.com', 'password456');
        $this->useCase->execute($request);
    }
}
