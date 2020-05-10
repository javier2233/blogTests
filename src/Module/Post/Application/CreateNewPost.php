<?php


namespace Blog\Module\Post\Application;


use Blog\Module\EventQueue\Domain\DomainEventPublisher;
use Blog\Module\Post\Domain\Post;
use Blog\Module\Post\Domain\PostBody;
use Blog\Module\Post\Domain\PostId;
use Blog\Module\Post\Domain\PostRepository;
use Blog\Module\Post\Domain\PostStatus;
use Blog\Module\Post\Domain\PostTitle;
use Blog\Module\Post\Domain\PostUserId;


class CreateNewPost
{
    private $postRepository;
    private $domainEventPublisher;

    public function __construct(PostRepository $postRepository, DomainEventPublisher $domainEventPublisher)
    {
        $this->postRepository = $postRepository;
        $this->domainEventPublisher = $domainEventPublisher;

    }

    public function create(PostId $postId, PostTitle $postTitle, PostBody $postBody, PostStatus $postStatus, PostUserId $postUserId)
    {
        $post = Post::create($postId, $postTitle, $postBody, $postStatus, $postUserId);

        $postSave = $this->postRepository->save($post);

        if (!$postSave) {
            throw new \Exception("The Post cannot be created");
        }

        if($postStatus->getToPublish()){
            $this->domainEventPublisher->publish(...$post->pullDomainEvents());
        }
        return $postSave;

    }

}