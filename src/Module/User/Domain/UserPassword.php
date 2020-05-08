<?php

namespace Blog\Module\User\Domain;


final class UserPassword
{
    private $password;

    public function __construct($password)
    {
        $this->password = $this->validatePassword($password);

    }

    private function validatePassword($password)
    {
        if(strlen($password) > 3 && strlen($password) < 28 ){
            if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password))
            {
                $password = $this->encryptPassword($password);
                return $password;
            }
        }
        throw new \InvalidArgumentException(sprintf("The password '%s' is invalid", $password));
    }

    private function encryptPassword($password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $password;
    }
}
