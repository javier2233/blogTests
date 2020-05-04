<?php


namespace Blog\module\domain;


final class UserEmail
{
    private $email;
    public function __construct(string $email)
    {
        $this->email = $this->validateEmail($email);
    }

    private function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = null;
        }
        return $email;
    }

}