<?php


namespace Blog\Module\User\Domain;


Interface UserRepository
{
    public function save($User): bool;
    public function search(UserId $userId): ?User;

}