<?php


namespace Blog\Module\Post\Domain;


class PostUserId
{
    private $postUserId;

    public function __construct($postUserId)
    {
        $this->postUserId = $postUserId;

    }
}