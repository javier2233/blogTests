<?php


namespace Blog\Module\User\Domain;


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
            throw new \InvalidArgumentException(sprintf("The email '%s' is invalid", $email));
        }
        return $email;
    }

}