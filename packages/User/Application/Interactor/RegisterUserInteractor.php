<?php

declare(strict_types=1);

namespace Package\User\Application\Interactor;

use Package\Shared\Domain\ValueObject\Email;
use Package\User\Application\InputData\RegisterUserInputData;
use Package\User\Application\UseCase\RegisterUserUseCase;
use Package\User\Domain\Entity\User;
use Package\User\Domain\Repository\UserRepository;
use Package\User\Domain\Service\Authentication;

class RegisterUserInteractor implements RegisterUserUseCase
{
    private $repository;

    private $authentication;

    public function __construct(UserRepository $repository, Authentication $authentication)
    {
        $this->repository = $repository;
        $this->authentication = $authentication;
    }

    public function handle(RegisterUserInputData $inputData): void
    {
        $user = $this->repository->create(User::new(
            new Email($inputData->email()),
            $inputData->password()
        ));
        $this->authentication->login($user);
    }
}
