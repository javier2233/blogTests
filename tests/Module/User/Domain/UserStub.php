<?php


namespace BlogTest\Module\User\Domain;


use Blog\Module\User\Domain\User;
use Blog\Module\User\Domain\UserEmail;
use Blog\Module\User\Domain\UserId;
use Blog\Module\User\Domain\UserPassword;

class UserStub
{
    public static function create()
    {
        $userId = new UserId("1");
        $userEmail = new UserEmail("javiercanonguzman@gmail.com");
        $userPassword = new UserPassword("correctPass1230");
        return User::create($userId, $userEmail, $userPassword);
    }

}