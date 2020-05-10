<?php


namespace Blog\Module\Post\Domain;


use Blog\Module\Event\Domain\AggregateRoot;

final class Post extends AggregateRoot
{
    private $postId;
    private $postTitle;
    private $postBody;
    private $postStatus;
    private $postUserId;

    public function __construct(PostId $postId ,PostTitle $postTitle, PostBody $postBody, PostStatus $postStatus, PostUserId $postUserId)
    {
        $this->postId = $postId;
        $this->postTitle = $postTitle;
        $this->postBody = $postBody;
        $this->postStatus = $postStatus;
        $this->postUserId = $postUserId;
    }

    public static function create(PostId $postId ,PostTitle $postTitle, PostBody $postBody, PostStatus $postStatus, PostUserId $postUserId)
    {
        $post = new self($postId, $postTitle, $postBody, $postStatus, $postUserId);
        $post->record(
            new PostCreatedDomainEvent(
                $postId->getPostId(),
                [
                    'title'    => $postTitle->getTitle(),
                ]
            )
        );
        return $post;
    }
}