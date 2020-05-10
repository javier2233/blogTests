Feature: I  create a new user
  to create a new post
  and publish it

  Scenario: Create user, post and publish
    Given Try to create a new User
    And I put the email "testemail@gmail.com"
    And the password "passwordInit123"
    When the application generate new UserId
    Then return success with true
    Given try to create a new Post
    And i put the PostTitle "My fist blog test"
    And write the PostBoby "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
    And i add PostStatus Publish 2
    And i crete PostId
    Then return generate post with true