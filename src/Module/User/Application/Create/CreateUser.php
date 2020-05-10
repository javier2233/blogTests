<?php


namespace Blog\Module\User\Application\Create;


use Blog\Module\User\Domain\User;
use Blog\Module\User\Domain\UserEmail;
use Blog\Module\User\Domain\UserId;
use Blog\Module\User\Domain\UserPassword;
use Blog\Module\User\Domain\UserRepository;

class CreateUser
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(UserId $userId, UserEmail $userEmail, UserPassword $userPassword){

        $user = User::create($userId, $userEmail, $userPassword);

        $user = $this->userRepository->save($user);

        if (!$user) {
            throw new \Exception("The user cannot be created");
        }

        return  $user;
    }




}