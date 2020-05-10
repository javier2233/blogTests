<?php

namespace BlogIntegration\PostCreate\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Blog\Module\EventQueue\Domain\DomainEventPublisher;
use Blog\Module\Post\Application\CreateNewPost;
use Blog\Module\Post\Domain\PostBody;
use Blog\Module\Post\Domain\PostId;
use Blog\Module\Post\Domain\PostRepository;
use Blog\Module\Post\Domain\PostStatus;
use Blog\Module\Post\Domain\PostTitle;
use Blog\Module\Post\Domain\PostUserId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Defines application features from the specific context.
 */
class CreatePostContext implements Context
{
   private $postId;
   private $postTitle;
   private $postBody;
   private $postStatus;
   private $postUserId;

    /**
     * @Given /^try to create a new Post$/
     */
    public function tryToCreateANewPost()
    {

    }

    /**
     * @Given /^i put the PostTitle "([^"]*)"$/
     */
    public function iPutThePostTitle($arg1)
    {
       $this->postTitle = new PostTitle($arg1);
    }

    /**
     * @Given /^write the PostBoby "([^"]*)"$/
     */
    public function writeThePostBoby($arg1)
    {
        $this->postBody = new PostBody($arg1);
    }

    /**
     * @Given /^i add PostStatus Publish (\d+)$/
     */
    public function iAddPostStatusPublish($arg1)
    {
        $this->postStatus = new PostStatus($arg1);
    }

    /**
      * @Given /^i crete PostId$/
      */
    public function iCretePostId()
    {
        $postId = Uuid::uuid4()->toString();
        $this->postId = new PostId($postId);
    }

    /**
     * @When /^my UserId is (\d+)$/
     */
    public function myUserIdIs($arg1)
    {
        $this->postUserId = new PostUserId($arg1);
    }

    /**
     * @Then /^return generate post with true$/
     */
    public function returnGeneratePostWithTrue()
    {
        $postRepository = \Mockery::mock(PostRepository::class);
        $domainEventPublisher = \Mockery::mock(DomainEventPublisher::class);
        $createNewPost = new CreateNewPost($postRepository, $domainEventPublisher);
        $postRepository->shouldReceive("save")->andReturnTrue();
        $domainEventPublisher->shouldReceive("publish")->andReturnNull();
        $createNewPostResult = $createNewPost->create($this->postId, $this->postTitle, $this->postBody, $this->postStatus, $this->postUserId);
        TestCase::assertTrue($createNewPostResult);
    }

}
