Feature: User visits the homepage
	In order to verify that the application is running
	As a user
	I want to view the homepage

#Checks that the necessary components are there
Scenario: View homepage
	When I enter the URL in a browser
	Then I should see "Another Day Another Scholar"
	And I should see a Keyword radio button
	And I should see an Author radio button
	And I should see a combo box
	And I should see a Submit button
	And I should see a search box

Scenario: Check for default settings
	Given I am on the homepage
	Then I should see "keyword" as the radio button value
	And I should see "10" as the combo box value

Scenario: Check that radio button values can be changed
	Given I am on the homepage
	When I choose "author" from the radio buttons
	Then I should see "author" as the radio button value

Scenario: Check that combo box values can be changed
	Given I am on the homepage
	When I choose "20" as the combo box value
	Then I should see "20" as the combo box value

#Scenario: Check for error message when submitting empty search box
#	Given I am on the homepage
#	When I click the Submit button
#	Then I should see "Please enter a valid keyword or author"

Scenario: Search with keyword 'artificial intelligence'
	Given I am on the homepage
	When I choose "keyword" from the radio buttons
	And I fill in "search" with "artificial intelligence"
	And I click the Submit button
	Then I should see "program"

Scenario: Search with author 'Smith'
	Given I am on the homepage
	When I choose "author" from the radio buttons
	And I fill in "search" with "Smith"
	And I click the Submit button
	Then I should see "application"

Scenario: Check for Paper List
	Given I am on the homepage
	When I fill in "search" with "artificial intelligence"
	And I click the Submit button
	And I click the word "intelligence"
	Then I should see "Title"
	And I should see "Author"
	And I should see "Journal"
	And I should see "Frequency"

Scenario: Check for history
	Given I am on the homepage
	And I fill in "search" with "artificial intelligence"
	And I click the Submit button
	Then I should see "History"

Scenario: Check for history
	Given I am on the homepage
	And I fill in "search" with "artificial intelligence"
	And I click the Submit button
	And I fill in search with "deep"
	And I choose "artificial intelligence" as the history value
	Then I should see "artificial intelligence"