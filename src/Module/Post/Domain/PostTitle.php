<?php


namespace Blog\Module\Post\Domain;


class PostTitle
{
    const LIMIT_CHARACTERS_TITLE = 50;
    private $title;

    public function __construct($title)
    {
        $this->title = $this->validateTitle($title);
    }

    private function validateTitle($title)
    {
        if(strlen($title) >= self::LIMIT_CHARACTERS_TITLE)
        {
            throw new \InvalidArgumentException("El titulo supera los 50 caracteres");
        }
        return $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

}