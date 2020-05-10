<?php


namespace Blog\Module\Post\Domain;


Interface PostRepository
{
    public function save(): bool ;

    public function search(PostId $postId): ?Post;

}