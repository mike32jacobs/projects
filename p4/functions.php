<!-- I got this file from the version that you created after reviewing my code. -->

<?php
function build_deck()
{
    // Dynamically create a deck of cards using a multidimensional array.
    $cardNames = array('2','3','4','5','6','7','8','9','10','J','Q','K','A');
    $cardValues = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10, 11);
    $cardSuits = array('Hearts','Spades','Diamonds','Clubs');

    $deck = array();

    foreach ($cardSuits as $suit) {
        for ($cardNumber = 0; $cardNumber< 13; $cardNumber++) {
            array_push($deck, array($cardNames[$cardNumber], $suit, $cardValues[$cardNumber]));
        }
    }

    return $deck;
}

// Find the sum of any hand
function calculate_total(array $hand)
{
    $sum = 0;
    $acesCount = 0;

    // Iterate through cards, and sum the values and count the aces
    for ($i=0; $i <count($hand); $i++) {
        $sum=$sum + $hand[$i][2];
        if ($hand[$i][0]=='A'){
            $acesCount++;
        }
    }

    // If sum is greater than 21, check to see if there is an ace
    // in the player's hand. If there is, count the total using a 1 instead of an 11.
    
    if ($sum>21) {
        // Recalculate the sum using 1 instead of 11
        // There is a bug in this code. It essentaally sets the value of each ace to 1. There may be a scenario when the player wants one ace to be worth 11 and another to be worth 1.
        $sum = $sum - 10*$acesCount;
    }

    return $sum;
}

function deal_to_player(array $player, int $numCards)
{
    global $deck;

    for ($i = 0; $i < $numCards; $i++) {
        $drawCard=array_shift($deck);
        array_push($player, $drawCard);
    }

    return $player;
}

function check_total(int $total)
{
    if ($total == 21) {
        return "blackjack";
    } elseif ($total > 21) {
        return "over";
    } elseif ($total < 21) {
        return "under";
    }
}

function check_winner()
{
    global $dealerTotal;
    global $playerTotal;
    
    if ($dealerTotal > 21){
        // Dealer Busts. 
        return 'player';
    }elseif (($playerTotal>$dealerTotal) and ($playerTotal<22)){
        // Nobody busts. player beats dealer
        return 'player';
    }elseif (($dealerTotal>$playerTotal) and ($dealerTotal<22)){
        // Nobody busts. dealer beats player
        return 'dealer';
    }elseif (($playerTotal==$dealerTotal)and($playerTotal<22)){
        // nobody busts and the score is tied. Player gets the win.
        return 'player';
    } else{
        // The only option left is the player busted before the dealer went
        return 'dealer';
    }
}

function dealer_turn()
{
    global $dealerHand;
    global $dealerTotal;

    // Dealer must hit on anything less than 17
    while ($dealerTotal< 17){
        $dealerHand = deal_to_player($dealerHand, 1);
        $dealerTotal = calculate_total($dealerHand);
    }
    // return $dealerTotal;
}