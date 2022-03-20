<?php

// Dynamically create a deck of cards using a multidimensional array.

$cardNames = array('2','3','4','5','6','7','8','9','10','J','Q','K','A');
$cardSuits =array('Hearts','Spades','Diamonds','Clubs');

$deck = array();

// Note: To use all four suits, $suit < 4. To use just one suit, use $suit < 1.This plays the game with only hearts.

for ($suit = 0; $suit < 4; $suit++) {
    for ($value = 2; $value< 15; $value++){
        array_push($deck, array($cardNames[$value - 2], $cardSuits[$suit], $value));
    }
}

// Shuffle the "deck."

shuffle($deck);

// Create an array for each player's hand

$player1Hand = [];
$player2Hand = [];

// Create a variable to count the number of rounds played.

$roundsPlayed = 0;

// Deal cards to each player. Toggle from player to player until the cards are gone.

$dealTo ='player1';

while (count($deck) > 0) {
    if($dealTo == 'player1'){
        $drawCard = array_shift($deck);
        array_push($player1Hand, $drawCard);
        $dealTo ='player2';
    } else {
        $drawCard = array_shift($deck);
        array_push($player2Hand, $drawCard);
        $dealTo ='player1';
    }
    
}

// Create variable to keep track of how many cards in each player's hand. 
// ?These two variable may not really be needed. I used them originally before I ended up creating arrays for cards remaining.

$cardsRemainingP1 = count($player1Hand);
$cardsRemainingP2 = count($player2Hand);

// Create arrays to keep track of the data from each round. One array for each piece of info.

$p1CardsPlayedData = [];
$p2CardsPlayedData = [];
$roundWinnersData = [];
$cardsRemainingP1Data = [];
$cardsRemainingP2Data =[]; 

// Create variable to keep track of what card indicates that a player needs to reshuffle
$p1ShuffleCard = $player1Hand[$cardsRemainingP1 - 1];
$p2ShuffleCard = $player2Hand[$cardsRemainingP2 - 1];


// Play the game until one player has zero cards left.

while ((count($player1Hand) != 0) && (count($player2Hand)!= 0)) {
    
    // Once both players have their cards, they should take the card off the top, and place it on the board.

    $p1Card = array_shift($player1Hand);
    $p2Card = array_shift($player2Hand);

    // Check to see if the card played indicates that a player should reshuffle for the next hand. Set a new card to indicate a player needs to reshuffle

    if ($p1Card == $p1ShuffleCard){
        shuffle($player1Hand);
        
        // If a player is down to the last card, the deck will be empty, so don't try to reshuffle. Check that the deck is not empty, Set a new card to indicate a player needs to reshuffle
        
        if (count($player1Hand)>0){
            $p1ShuffleCard = $player1Hand[count($player1Hand) - 1];
        }
    }
    if ($p2Card == $p2ShuffleCard){
        shuffle($player2Hand);
        if (count($player2Hand)>0){
            $p2ShuffleCard = $player2Hand[count($player2Hand) - 1];
        }

    }


    // Compare the values of player1Card and player2Card. The interesting thing will be how to compare cards. The result of the comparison will either add cards to one of the player's hands or discard them.

    $roundWinner = 'tie';
    
    if ($p1Card[2] == $p2Card[2]){
        
        // It is a tie. Both cards are removed

        $roundWinner = 'tie';
    } elseif ($p1Card[2] > $p2Card[2]) {
        
        // Player one wins. Add both card to player1Hand

        array_push($player1Hand, $p1Card);
        array_push($player1Hand, $p2Card);
        $roundWinner = 'Player 1';

    } else {
        
        // Player 2 wins. Add both cards to player2Hand

        array_push($player2Hand, $p1Card);
        array_push($player2Hand, $p2Card);
        $roundWinner = 'Player 1';
    }

    // Count cards in each player's hand, and iterate the round #
    
    $cardsRemainingP1 = count($player1Hand);
    $cardsRemainingP2 = count($player2Hand);
    $roundsPlayed++;

    // Enter the data from the round into appropriate arrays

    array_push($p1CardsPlayedData, $p1Card);
    array_push($p2CardsPlayedData, $p2Card);
    array_push($roundWinnersData, $roundWinner);
    array_push($cardsRemainingP1Data, $cardsRemainingP1);
    array_push($cardsRemainingP2Data, $cardsRemainingP2);

}

// Determine the game winner

$gameWinner = null;
if (count($player1Hand) == 0) {
    $gameWinner = 'Player 2';
} else{
    $gameWinner = 'Player 1';
}

 

require 'index-view.php';