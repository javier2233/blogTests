<?php


namespace BlogTest\Module\Post\Application;


use Blog\Module\EventQueue\Domain\DomainEventPublisher;
use Blog\Module\Post\Application\CreateNewPost;
use Blog\Module\Post\Domain\Post;
use Blog\Module\Post\Domain\PostId;
use Blog\Module\Post\Domain\PostRepository;
use Blog\Module\Post\Domain\PostStatus;
use Blog\Module\Post\Domain\PostTitle;
use Blog\Module\Post\Domain\PostUserId;
use BlogTest\Module\Post\Domain\PostBodyStub;
use PHPUnit\Framework\TestCase;

class NewPostUseCaseTest extends TestCase
{

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $postRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $domainEventPublisher;

    /**
     * @var CreateNewPost
     */
    private $createNewPost;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepositoryMock = \Mockery::mock(PostRepository::class);
        $this->domainEventPublisher= \Mockery::mock(DomainEventPublisher::class);
        $this->createNewPost = new CreateNewPost($this->postRepositoryMock, $this->domainEventPublisher);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->postRepositoryMock = null;
        $this->domainEventPublisher= null;
    }

    /**
     * @test
     */
    public function ShouldCreateNewPostUseCase()
    {
        $postId = new PostId("1232");
        $postTitle = new PostTitle("Title to test use case");
        $postBody = PostBodyStub::create(1);
        $postStatus = new PostStatus(1);
        $postUserId = new PostUserId(001);
        $this->postRepositoryMock->shouldReceive("save")->andReturnTrue();
        $this->domainEventPublisher->shouldReceive("publish")->andReturnNull();
        $resultCreateNewPost = $this->createNewPost->create($postId, $postTitle, $postBody, $postStatus, $postUserId);
        $this->assertTrue($resultCreateNewPost);
    }

    /**
     * @test
     */
    public function ShouldDontCreateNewPostUseCaseReturnException()
    {
        $this->expectException(\Exception::class);
        $postId = new PostId("1232");
        $postTitle = new PostTitle("Title to test use case");
        $postBody = PostBodyStub::create(4);
        $postStatus = new PostStatus(2);
        $postUserId = new PostUserId(001);
        $this->postRepositoryMock->shouldReceive("save")->andReturnFalse();
        $this->createNewPost->create($postId, $postTitle, $postBody, $postStatus, $postUserId);
    }
}