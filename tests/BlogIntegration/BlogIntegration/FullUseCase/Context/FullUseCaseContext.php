<?php


namespace BlogIntegration\FullUseCase\Context;


use Behat\Behat\Context\Context;
use Blog\Module\EventQueue\Domain\DomainEventPublisher;
use Blog\Module\Post\Application\CreateNewPost;
use Blog\Module\Post\Domain\PostBody;
use Blog\Module\Post\Domain\PostId;
use Blog\Module\Post\Domain\PostRepository;
use Blog\Module\Post\Domain\PostStatus;
use Blog\Module\Post\Domain\PostTitle;
use Blog\Module\Post\Domain\PostUserId;
use Blog\Module\User\Application\Create\CreateUser;
use Blog\Module\User\Domain\UserEmail;
use Blog\Module\User\Domain\UserId;
use Blog\Module\User\Domain\UserPassword;
use Blog\Module\User\Domain\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class FullUseCaseContext implements Context
{
    private $postId;
    private $postTitle;
    private $postBody;
    private $postStatus;
    private $userEmail;
    private $userPass;
    private $userId;


    /**
     * @Given /^Try to create a new User$/
     */
    public function tryToCreateANewUser()
    {

    }

    /**
     * @Given /^I put the email "([^"]*)"$/
     */
    public function iPutTheEmail($arg1)
    {
        $this->userEmail = new UserEmail($arg1);
    }

    /**
     * @Given /^the password "([^"]*)"$/
     */
    public function thePassword($arg1)
    {
        $this->userPass = new UserPassword($arg1);
    }


    /**
     * @When the application generate new UserId
     */
    function TheApplicationGenerateNewUserId()
    {
        $userId = Uuid::uuid4()->toString();
        $this->userId = new UserId($userId);
    }

    /**
     * @Then /^return success with true$/
     */
    function returnSuccessWithTrue()
    {
        $userRepository = \Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive("save")->andReturnTrue();
        $createUser = new CreateUser($userRepository);
        $createUserStatus = $createUser->create($this->userId, $this->userEmail, $this->userPass);
        TestCase::assertTrue($createUserStatus);
    }

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
     * @Then /^return generate post with true$/
     */
    public function returnGeneratePostWithTrue()
    {
        $postRepository = \Mockery::mock(PostRepository::class);
        $domainEventPublisher = \Mockery::mock(DomainEventPublisher::class);
        $createNewPost = new CreateNewPost($postRepository, $domainEventPublisher);
        $postRepository->shouldReceive("save")->andReturnTrue();
        $domainEventPublisher->shouldReceive("publish")->andReturnNull();
        $userId = $this->userId->getUserId();
        $postUserId = new PostUserId($userId);
        $createNewPostResult = $createNewPost->create($this->postId, $this->postTitle, $this->postBody, $this->postStatus, $postUserId);
        TestCase::assertTrue($createNewPostResult);
    }

}