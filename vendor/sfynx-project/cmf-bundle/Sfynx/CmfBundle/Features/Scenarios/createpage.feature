# language: en
@mink:my_session_selenium
Feature: I would like to log in to the system

    Background: Anonymous access to login page
      Given I am logged as "anonymous"
        And I go to "/login"

    Scenario: Log in as admin
      Given I am logged as "anonymous"
        And I go to "/en/"
       Then the response should contain "form-connexion"
       Then I should not see "Logged in as user"
        And I fill in "_username" with "admin"
        And I fill in "_password" with "admin"
        And I press "OK"
       When I wait for 3 seconds
       Then I should see "admin"

   