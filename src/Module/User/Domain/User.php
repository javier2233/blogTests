<?php

namespace Blog\Module\User\Domain;

final class User
{
    private $userId;
    private $userEmail;
    private $userPassword;

    public function __construct(UserId $userId, UserEmail $userEmail, UserPassword $userPassword)
    {
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
    }

    public static function create(UserId $userId, UserEmail $userEmail, userPassword $userPassword): User
    {
        return new self($userId, $userEmail,$userPassword);
    }


}