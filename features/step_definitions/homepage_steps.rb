When(/^I enter the URL in a browser$/) do
  visit ui_url ''
end

Then(/^I should see "(.*?)"$/) do |text|
  page.should have_content text
end

Given(/^I am on the homepage$/) do
  visit ui_url ''
end

Then(/^I should see "(.*?)" as the radio button value$/) do |value|
  find_field(value).should be_checked
end

Then(/^I should see "(.*?)" as the combo box value$/) do |value|
  find("Page Limit").value.should eq(value) #combo_box should be whatever identifier it is
end

When(/^I fill in "(.*?)" with "(.*?)"$/) do |element, text|
  fill_in element, with: text
end

When(/^I choose "(.*?)" from the combo box$/) do |choice|
  select(choice, :from => 'Page Limit') #This may not be the actual name of the combo box
end

Then(/^the value of the combo box should be "(.*?)"$/) do |value|
  find("Page Limit").value.should eq(value) #combo_box should be whatever identifier it is
end

When(/^I choose "(.*?)" from the radio buttons$/) do |choice|
  choose(choice)
end

Then(/^the value of the radio button should be "(.*?)"$/) do |value|
  find_field(value).should be_checked
end

When(/^I click "(.*?)"$/) do |button_name|
  click_button button_name
end

Given(/^I fill in "(.*?)" with "(.*?)"$/) do |element, text|
  fill_in element, with: text
end

Then(/^I should not see "(.*?)"$/) do |text|
  page.should_not have_content text
end

Given(/^I choose "(.*?)" from the radio buttons$/) do |choice|
  choose(choice)
end
