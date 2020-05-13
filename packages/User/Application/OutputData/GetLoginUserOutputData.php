<?php

declare(strict_types=1);

namespace Package\User\Application\OutputData;

class GetLoginUserOutputData
{
    private $loginUser;

    public function __construct(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }

    public function loginUser(): LoginUser
    {
        return $this->loginUser;
    }
}
