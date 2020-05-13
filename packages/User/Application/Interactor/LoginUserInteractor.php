<?php

declare(strict_types=1);

namespace Package\User\Application\Interactor;

use Package\Shared\Domain\ValueObject\Email;
use Package\User\Application\InputData\LoginUserInputData;
use Package\User\Application\OutputData\LoginUserOutputData;
use Package\User\Application\UseCase\LoginUserUseCase;
use Package\User\Domain\Repository\UserRepository;
use Package\User\Domain\Service\Authentication;

class LoginUserInteractor implements LoginUserUseCase
{
    private $repository;

    private $authentication;

    public function __construct(UserRepository $repository, Authentication $authentication)
    {
        $this->repository = $repository;
        $this->authentication = $authentication;
    }

    public function handle(LoginUserInputData $inputData): LoginUserOutputData
    {
        $user = $this->repository->findByEmail(new Email($inputData->email()));
        $isSuccessful = $user && password_verify($inputData->rawPassword(), $user->password());

        if ($isSuccessful) {
            $this->authentication->login($user);
        }
        return new LoginUserOutputData($isSuccessful);
    }
}
