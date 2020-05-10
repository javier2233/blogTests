<?php


namespace BlogTest\Module\Post\Domain;


use Blog\Module\Post\Domain\Post;
use Blog\Module\Post\Domain\PostBody;
use Blog\Module\Post\Domain\PostId;
use Blog\Module\Post\Domain\PostRepository;
use Blog\Module\Post\Domain\PostStatus;
use Blog\Module\Post\Domain\PostTitle;
use Blog\Module\Post\Domain\PostUserId;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $postRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepositoryMock = $this->createMock(PostRepository::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->postRepositoryMock = null;
    }

    /**
     * @test
     */
    public function ShouldCreatePostObject()
    {

        $this->postRepositoryMock->method("search")->willReturn(null);
        $postId = new PostId("1");
        $postTitle = new PostTitle("title to test");
        $postBody = new PostBody("asñañlskdañlskdañlskdñlaksdañslkdñlkñasdlkasldl asldkañsldkalñskd ñalsk dñlaskdñlaksdlñkañlskd ñlaks lñaksdlñkasd");
        $postStatus = new PostStatus(2);
        $postUser = new PostUserId("123");
        $this->post = Post::create($postId, $postTitle, $postBody, $postStatus, $postUser);
        $this->assertInstanceOf(Post::class, $this->post);

    }
}