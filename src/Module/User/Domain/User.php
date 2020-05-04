<?php

namespace Blog\module\domain;

final class User
{
    private $userEmail;
    private $userPassword;
    public function __construct(UserEmail $userEmail, UserPassword $userPassword)
    {
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
    }
}