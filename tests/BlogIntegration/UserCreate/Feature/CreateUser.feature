Feature: Create a new User
  I need create new User
  for create new Post
  in the Blog

  Scenario: Generate New User
    Given Try to create a new User
    And I put the email "javiercanonguzman@gmail.com"
    And the password "myTestPass123"
    When the application generate new UserId
    Then return success with true