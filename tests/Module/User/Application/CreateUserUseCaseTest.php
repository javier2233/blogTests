<?php


namespace BlogTest\Module\User\Application;


use Blog\Module\User\Application\Create\CreateUser;
use Blog\Module\User\Domain\User;
use Blog\Module\User\Domain\UserEmail;
use Blog\Module\User\Domain\UserId;
use Blog\Module\User\Domain\UserPassword;
use Blog\Module\User\Domain\UserRepository;
use BlogTest\Module\User\Domain\UserStub;
use Mockery\Mock;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;


class CreateUserUseCaseTest extends TestCase
{
    /**
     * @var CreateUser
     */
    private $createUser;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userRepositoryMock;


    protected function setUp(): void
    {
        $this->userRepositoryMock = \Mockery::mock(UserRepository::class);
        $this->createUser = new CreateUser($this->userRepositoryMock);
    }

    /**
     * @test
     */
    public function ShouldDnotSaveUser()
    {
        $this->expectException(\Exception::class);
        $userId = new UserId("1");
        $userEmail = new UserEmail("javiercanonguzman@gmail.com");
        $userPassword = new UserPassword("correctPass1230");
        $this->userRepositoryMock->shouldReceive("save")->andReturnFalse();
        $this->createUser->create($userId, $userEmail, $userPassword);
    }

    /**
     * @test
     */
    public function ShouldSaveUser()
    {
        $userId = new UserId("1");
        $userEmail = new UserEmail("javiercanonguzman@gmail.com");
        $userPassword = new UserPassword("correctPass1230");
        $this->userRepositoryMock->shouldReceive("save")->andReturnTrue();
        $createUserStatus = $this->createUser->create($userId, $userEmail, $userPassword);
        $this->assertTrue($createUserStatus);
    }
}