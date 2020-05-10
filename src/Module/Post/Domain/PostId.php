<?php


namespace Blog\Module\Post\Domain;


class PostId
{
    private $postId;

    public function __construct($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }


}