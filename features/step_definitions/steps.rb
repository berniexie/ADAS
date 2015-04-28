#Visits the URL
When(/^I enter the URL in a browser$/) do
	visit ui_url ''
end

#Sets condition that you are on the homepage
Given(/^I am on the homepage$/) do
	visit ui_url ''
end

#Checks if the page contains given content
Then(/^I should see "(.*?)"$/) do |text|
	page.should have_content text
end

#Checks that there is a Keyword radio button
Then(/^I should see a Keyword radio button$/) do
	page.should have_selector 'input[type=radio][name=type][value=keyword]'
end

#Checks that there is an Author radio button
Then(/^I should see an Author radio button$/) do
	page.should have_selector 'input[type=radio][name=type][value=author]'
end

#Checks that there is a combo box
Then(/^I should see a combo box$/) do
	page.should have_selector 'select[name=limit]'
end

#Checks that there is a submit button
Then(/^I should see a Submit button$/) do
	page.should have_selector 'input[type=submit][class=buttons][value=Submit]'
end

#Checks that there is a search box
Then(/^I should see a search box$/) do
	page.should have_selector 'input[type=text][id=tags][name=search]'
end

#Checks that the given radio button is checked
Then(/^I should see "(.*?)" as the radio button value$/) do |arg1|
#	page.should have_selector 'input[type=radio][name=type][value=' + arg1 + '][checked]'
	find("input[type=radio][name=type][value=" + arg1 + "]").should be_checked
end

#Checks that the given value is the value of the combo box
Then(/^I should see "(.*?)" as the combo box value$/) do |arg1|
	expect(page).to have_select('limit', selected: arg1)
end

#Chooses the value of the radio button
When(/^I choose "(.*?)" from the radio buttons$/) do |arg1|
	find("input[type=radio][name=type][value=" + arg1 + "]").click
end

#Chooses the value of the combo box
When(/^I choose "(.*?)" as the combo box value$/) do |arg1|
	select(arg1, :from => 'limit')
end

#Clicks the Submit button
When(/^I click the Submit button$/) do
	find('input[type=submit][class=buttons][value=Submit]').click
end

#Fills in the search box with the given text
When(/^I fill in "(.*?)" with "(.*?)"$/) do |arg1, arg2|
	fill_in arg1, with: arg2
end

#Clicks the word in the word cloud
When(/^I click the word "(.*?)"$/) do |arg1|
	find(arg1).click
end

Given(/^I choose "(.*?)" as the history value$/) do |arg1|
	find("input[type=radio][name=type][value=" + arg1 + "]").click
end

