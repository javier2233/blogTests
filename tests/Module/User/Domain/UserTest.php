<?php


namespace BlogTest\Module\User\Domain;


use Blog\Module\User\Domain\User;
use Blog\Module\User\Domain\UserEmail;
use Blog\Module\User\Domain\UserId;
use Blog\Module\User\Domain\UserPassword;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @var User */
    private $user;

    /** @test */
    public function shouldCreateUser()
    {
        $this->user = User::create(
            new UserId("1"),
            new UserEmail("javiercanonguzman@gmail.com"),
            new UserPassword("javier2233")
        );

        $this->assertInstanceOf(User::class, $this->user);

    }

    /**
     * @test
     * @dataProvider passwordProviders
     */
    public function shouldReturnExceptionUserCreateWithInvalidPass($passwordProviders)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->user = User::create(
            new UserId("1"),
            new UserEmail("good-email@hotmail.com"),
            new UserPassword($passwordProviders)
        );
    }

    /**
     * @test
     * @dataProvider emailsProviders
     */
    public function shouldReturnExceptionUserCreateWithInvalidEmail($emailsProviders)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->user = User::create(
            new UserId("1"),
            new UserEmail($emailsProviders),
            new UserPassword("javier2233")
        );
    }

    public function emailsProviders()
    {
        return [
            ["javiercan.on.gmail.com"],
            ["javi@ercanon@gmail.com"],
            ["javier canon@gmail.com"],
            ["javiercanon@@gmail.com"]
        ];
    }

    public function passwordProviders()
    {
        return [
            ["aksjdlaksd"],
            ["123123123"],
        ];
    }
}