<?php

declare(strict_types=1);

namespace Package\User\Application\Interactor;

use Package\User\Application\OutputData\GetLoginUserOutputData;
use Package\User\Application\OutputData\LoginUser;
use Package\User\Application\UseCase\GetLoginUserUseCase;
use Package\User\Domain\Repository\UserRepository;
use Package\User\Domain\Service\Authentication;

class GetLoginUserInteractor implements GetLoginUserUseCase
{
    private $repository;

    private $authentication;

    public function __construct(UserRepository $repository, Authentication $authentication)
    {
        $this->repository = $repository;
        $this->authentication = $authentication;
    }

    public function handle(): GetLoginUserOutputData
    {
        $user = $this->repository->findById($this->authentication->getLoginId());
        return new GetLoginUserOutputData(new LoginUser($user->id(), $user->email()->value()));
    }
}
