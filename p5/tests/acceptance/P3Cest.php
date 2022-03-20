<?php

class P3Cest
{
    // tests
    public function initiateGame0(AcceptanceTester $I)
    {
        // Don't input any data to the form
        $I->amOnPage('/');
        $I->click('[test=submit-button]');
        
        $errorMessage1 = 'The value for winning-number must be greater than or equal to 11';
        $errorMessage2 = 'The value for max-count must be less than or equal to 5';

        // // Confirm we see the error messages on the page.
        $I->see($errorMessage1,'[test=error-messages]');
        $I->see($errorMessage2,'[test=error-messages]');

    }

    public function initiateGame(AcceptanceTester $I)
    {
        // Initiate the game with good data
        $I->amOnPage('/');
        $I->fillField('[test=winning-number-input]',23);
        $I->fillField('[test=max-count-input]',3);
        $I->click('[test=submit-button]');

        $I->amOnPage('/play');

 
        $I->seeElement('[test=winning-score]');
        // $I->see('23','[test=winning-score]');

        $I->seeElement('[test=max-count]');
        // $I->see('3','[test=max-count]');

        // //Look for specific text
        $twenty_three = $I->grabTextFrom('[test=winning-score]');
        $I->comment('The winning score is '.$twenty_three);


    }

    public function initiateGame2(AcceptanceTester $I)
    {
        // input bad data
        $I->amOnPage('/');
        $I->fillField('[test=winning-number-input]',23);
        $I->fillField('[test=max-count-input]',6);
        $I->click('[test=submit-button]');

        $I->amOnPage('/');
        // $I->click('[test=submit-button]');
        
        // $errorMessage1 = 'The value for winning-number must be greater than or equal to 11';
        // $errorMessage2 = 'The value for max-count must be less than or equal to 5';

        // // Confirm we see the error messages on the page.
        // $I->see($errorMessage1,'[test=error-messages]');
        // $I->see($errorMessage2,'[test=error-messages]');

    }
    public function radio_button_count(AcceptanceTester $I)
    {
        // Initiate the game with good data. If the max count is set to 4, then we should see 4 radio buttons
        $I->amOnPage('/');
        $I->fillField('[test=winning-number-input]',15);
        $I->fillField('[test=max-count-input]',4);
        $I->click('[test=submit-button]');

        $I->amOnPage('/play');
 
        $I->see('Add 3 to Count');

    }

    public function history(AcceptanceTester $I)
    {
        // Don't input any data to the form
        $I->amOnPage('/');

        $I->click('[test=history-link]');


        $I->amOnPage('/history');

        $I->seeInTitle('Game History');
        $I->see('Game History');

    }
}