<?php

namespace BlogIntegration\UserCreate\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Blog\Module\User\Application\Create\CreateUser;
use Blog\Module\User\Domain\User;
use Blog\Module\User\Domain\UserEmail;
use Blog\Module\User\Domain\UserId;
use Blog\Module\User\Domain\UserPassword;
use Blog\Module\User\Domain\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Defines application features from the specific context.
 */
class UserCreateContext implements Context
{
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
}
