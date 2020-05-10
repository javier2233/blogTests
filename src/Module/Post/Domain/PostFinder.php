<?php


namespace Blog\Module\Post\Domain;


class PostFinder
{
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PostId $id): ?Post
    {
        return $video = $this->repository->search($id);

    }

}