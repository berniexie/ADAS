Feature: User visits the homepage
	In order to verify that the application is running
	As a user
	I want to view the homepage

Scenario: View homepage
	When I enter the URL in a browser
	Then I should see "Another Day Another Scholar"

Scenario: Check for default settings
	Given I am on the homepage
	Then I should see "Keyword" as the radio button value
	And I should see "10" as the combo box value
	And I should see "Show History"

Scenario: Enter text with default settings
	Given I am on the homepage
	When I fill in "Search" with "artificial intelligence"
	Then I should see "artificial intelligence"

Scenario: Enter combo box value with default settings
	Given I am on the homepage
	When I choose "20" from the combo box
	Then the value of the combo box should be "20"
	And I should see "20"

Scenario: Enter radio button value (Keyword) with default settings
	Given I am on the homepage
	When I choose "Keyword" from the radio buttons
	Then the value of the radio button should be "Keyword"

Scenario: Enter radio button value (Researcher Name) with default settings
	Given I am on the homepage
	When I choose "Researcher Name" from the radio buttons
	Then the value of the radio button should be "Researcher Name"

Scenario: Click 'Submit' with default settings
	Given I am on the homepage
	When I click "Submit"
	Then I should see "Please enter a search query"

Scenario: Click 'Show History' with default settings
	Given I am on the homepage
	When I click "Show History"
	Then I should see "Empty"

Scenario: Add text with text already in the search box
	Given I am on the homepage
	And I fill in "Search" with "artificial"
	When I fill in "Search" with "artificial intelligence"
	Then I should see "artificial intelligence"

Scenario: Enter combo box value with default settings except search has text
	Given I am on the homepage
	And I fill in "Search" with "artificial"
	When I choose "30" from the combo box
	Then the value of the combo box should be "30"
	And I should see "30"

Scenario: Enter radio button value (Keyword) with default settings except search has text
	Given I am on the homepage
	And I fill in "Search" with "artificial"
	When I choose "Keyword" from the radio buttons
	Then the value of the radio button should be "Keyword"

Scenario: Enter radio button value (Researcher Name) w/ default settings except search has text
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	When I choose "Researcher Name" from the radio buttons
	Then the value of the radio button should be "Researcher Name"
	And I should see "Andrey Angelov Elenkov"

Scenario: Click 'Submit' with default settings except search has text
	Given I am on the homepage
	And I fill in "Search" with "artificial"
	When I click "Submit"
	Then I should see "Loading..."

Scenario: Click 'Show History' with default settings except search has text
	Given I am on the homepage
	And I fill in "Search" with "artificial"
	When I click "Show History"
	Then I should see "Empty"

Scenario: Two letters in search and choose 'Researcher Name'
	Given I am on the homepage
	And I fill in "Search" with "An"
	When I choose "Researcher Name" from the radio buttons
	Then the value of the radio button should be "Researcher Name"
	And I should not see "Andrey Angelov Elenkov"

Scenario: Add text with two letters in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "An"
	And I choose "Researcher Name" from the radio buttons
	When I fill in "Search" with "Andrey Angelov Ele"
	Then the value of the radio button should be "Researcher Name"
	And I should see "Andrey Angelov Elenkov"

Scenario: Enter combo box value with two letters in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "An"
	And I choose "Researcher Name" from the radio buttons
	When I choose "30" from the combo box
	Then the value of the combo box should be "30"
	And I should see "30"
	And the value of the radio button should be "Researcher Name"
	And I should not see "Andrey Angelov Elenkov"

Scenario: Enter radio button value (Keyword) w/ two letters in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "An"
	And I choose "Researcher Name" from the radio buttons
	When I choose "Keyword" from the radio buttons
	Then the value of the radio button should be "Keyword"
	And I should not see "Andrey Angelov Elenkov"

Scenario: Enter radio button value (Researcher Name) w/ two letters in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "An"
	And I choose "Researcher Name" from the radio buttons
	When I choose "Researcher Name" from the radio buttons
	Then the value of the radio button should be "Researcher Name"
	And I should not see "Andrey Angelov Elenkov"

Scenario: Click 'Submit' with two letters in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	And I choose "Researcher Name" from the radio buttons
	When I click "Submit"
	Then I should see "Please enter more characters to get an autofill suggestion"

Scenario: Click 'Show History' with text in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "An"
	And I choose "Researcher Name" from the radio buttons
	When I click "Show History"
	Then I should see "Empty"
	And I should not see "Andrey Angelov Elenkov"

Scenario: Add text with text in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	And I choose "Researcher Name" from the radio buttons
	When I fill in "Search" with "Andrey Angelov Ele"
	Then the value of the radio button should be "Researcher Name"
	And I should see "Andrey Angelov Elenkov"

Scenario: Enter combo box value with text in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	And I choose "Researcher Name" from the radio buttons
	When I choose "30" from the combo box
	Then the value of the combo box should be "30"
	And I should see "30"
	And the value of the radio button should be "Researcher Name"
	And I should see "Andrey Angelov Elenkov"

Scenario: Enter radio button value (Keyword) with text in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	And I choose "Researcher Name" from the radio buttons
	When I choose "Keyword" from the radio buttons
	Then the value of the radio button should be "Keyword"
	And I should not see "Andrey Angelov Elenkov"

Scenario: Enter radio button value (Researcher Name) w/ text in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	And I choose "Researcher Name" from the radio buttons
	When I choose "Researcher Name" from the radio buttons
	Then the value of the radio button should be "Researcher Name"
	And I should see "Andrey Angelov Elenkov"

Scenario: Click 'Submit' with text in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	And I choose "Researcher Name" from the radio buttons
	When I click "Submit"
	Then I should see "Loading..."

Scenario: Click 'Show History' with text in search and 'Researcher Name' chosen
	Given I am on the homepage
	And I fill in "Search" with "Andrey Angelov"
	And I choose "Researcher Name" from the radio buttons
	When I click "Show History"
	Then I should see "Empty"
	And I should see "Andrey Angelov Elenkov"
