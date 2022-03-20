# Project 3
+ By: *Michael Jacobs*
+ URL: <http://e2p3.nhroyal.com/>

## Graduate requirement
*x one of the following:*
+ [x] I have integrated testing into my application
+ [ ] I am taking this course for undergraduate credit and have opted out of integrating testing into my application

## Outside resources


## Notes for instructor
*I decided to try a different game. I chose this because of my experiences with P2. I wanted to create a minimum viable project. My plan was to get the game working, and then make it more complex by adding different computer characters. I wanted to make each one more intelligent than the previous.  *
*Testing Some of my tests fail because after I initiate a game and start playing, I can no longer see HTML for the '/play' page. I think that this is because I am using a view instead of a redirect. You and I spoke about the differences between the two.*
*This was a great learning process for me, but the game is certainly not ready for prime time. I think that I would like to complete this game at a later time. I would love to see how a professional would execute the idea. I am sure that it could be much easier.*
*Global variables is a concept that I need to work with. I declared a few of them, and intended to use them regularly. However, mid-development, I started using the database to store data for each turn. I am not sure if I was actually changing the values of the global variables from within my functions.*

## Codeception testing output
```
Acceptance Tests (5) ------------------------------------
P3Cest: Initiate game0
Signature: P3Cest:initiateGame0
Test: tests/acceptance/P3Cest.php:initiateGame0
Scenario --
 I am on page "/"
 I click "[test=submit-button]"
 I see "The value for winning...","[test=error-messages]"
 I see "The value for max-cou...","[test=error-messages]"
 PASSED 

P3Cest: Initiate game
Signature: P3Cest:initiateGame
Test: tests/acceptance/P3Cest.php:initiateGame
Scenario --
 I am on page "/"
 I fill field "[test=winning-number-input]",23
 I fill field "[test=max-count-input]",3
 I click "[test=submit-button]"
 I am on page "/play"
 I see element "[test=winning-score]"
 FAIL 

P3Cest: Initiate game2
Signature: P3Cest:initiateGame2
Test: tests/acceptance/P3Cest.php:initiateGame2
Scenario --
 I am on page "/"
 I fill field "[test=winning-number-input]",23
 I fill field "[test=max-count-input]",6
 I click "[test=submit-button]"
 I am on page "/"
 PASSED 

P3Cest: Radio_button_count
Signature: P3Cest:radio_button_count
Test: tests/acceptance/P3Cest.php:radio_button_count
Scenario --
 I am on page "/"
 I fill field "[test=winning-number-input]",15
 I fill field "[test=max-count-input]",4
 I click "[test=submit-button]"
 I am on page "/play"
 I see "Add 3 to Count"
 FAIL 

P3Cest: History
Signature: P3Cest:history
Test: tests/acceptance/P3Cest.php:history
Scenario --
 I am on page "/"
 I click "[test=history-link]"
 I am on page "/history"
 I see in title "Game History"
 I see "Game History"
 PASSED 

---------------------------------------------------------


Time: 00:00.195, Memory: 12.00 MB

There were 2 failures:

---------
1) P3Cest: Initiate game
 Test  tests/acceptance/P3Cest.php:initiateGame
 Step  See element "[test=winning-score]"
 Fail  Element located either by name, CSS or XPath element with '[test=winning-score]' was not found.

Scenario Steps:

 6. $I->seeElement("[test=winning-score]") at tests/acceptance/P3Cest.php:32
 5. $I->amOnPage("/play") at tests/acceptance/P3Cest.php:29
 4. $I->click("[test=submit-button]") at tests/acceptance/P3Cest.php:27
 3. $I->fillField("[test=max-count-input]",3) at tests/acceptance/P3Cest.php:26
 2. $I->fillField("[test=winning-number-input]",23) at tests/acceptance/P3Cest.php:25
 1. $I->amOnPage("/") at tests/acceptance/P3Cest.php:24

Artifacts:

Html: /var/www/e2/p3/tests/_output/P3Cest.initiateGame.fail.html
Response: /var/www/e2/p3/tests/_output/P3Cest.initiateGame.fail.html

---------
2) P3Cest: Radio_button_count
 Test  tests/acceptance/P3Cest.php:radio_button_count
 Step  See "Add 3 to Count"
 Fail  Failed asserting that  on page /play
-->  pre.sf-dump { display: block; white-space: pre; padding: 5px; overflow: initial !important; } pre.sf-dump:after { content: ""; visibility: hidden; display: block; height: 0; clear: both; } pre.sf-dump span { display: inline; } pre.sf-dump .sf-dump-compact { display: none; } pre.sf-dump a { text-dec
[Content too long to display. See complete response in '/var/www/e2/p3/tests/_output/' directory]
--> contains "Add 3 to Count".

Scenario Steps:

 6. $I->see("Add 3 to Count") at tests/acceptance/P3Cest.php:74
 5. $I->amOnPage("/play") at tests/acceptance/P3Cest.php:72
 4. $I->click("[test=submit-button]") at tests/acceptance/P3Cest.php:70
 3. $I->fillField("[test=max-count-input]",4) at tests/acceptance/P3Cest.php:69
 2. $I->fillField("[test=winning-number-input]",15) at tests/acceptance/P3Cest.php:68
 1. $I->amOnPage("/") at tests/acceptance/P3Cest.php:67

Artifacts:

Html: /var/www/e2/p3/tests/_output/P3Cest.radio_button_count.fail.html
Response: /var/www/e2/p3/tests/_output/P3Cest.radio_button_count.fail.html

FAILURES!
Tests: 5, Assertions: 6, Failures: 2.
```