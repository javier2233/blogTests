<?php


namespace Blog\Module\Post\Domain;


class PostBody
{
    const LIMIT_CHARACTERS_BODY = 2000;
    private $body;

    public function __construct($body)
    {
        $this->body = $this->validateBody($body);
    }

    private function validateBody($body)
    {
        if(strlen($body) > self::LIMIT_CHARACTERS_BODY)
        {
            throw new \InvalidArgumentException("El body supera los 2000 caracteres");
        }
        return $body;
    }

}