<?php
session_start();

require 'functions.php';

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $deck = $results['deck'];
    $dealerHand = $results['dealerHand'];
    $playerHand = $results['playerHand'];
    $playerTotal = $results['playerTotal'];
    $dealerTotal = $results['dealerTotal'];
    $winner = $results['winner'];

    // This null coalescing operator came from Professor Buck. Thanks for the help

    $move = $results['move'] ?? null;
    

}

# Display a new game if there are no results to work with
# (e.g. we're coming to the page for the first time)
#
# Or...
#
# If the user is coming to this page from the "Play again" link.
# That link appends a `reset` query string like so:
# <a href='index.php?reset=true'>Play again</a>
# So we look for that `rese`t value in the $_GET superglobal
// This was super helpful. Thank you for the code

if (!isset($results) or isset($_GET['reset'])) {
    
    # Clear previous game data
    $winner = null;
    $_SESSION['results'] = null;
    
    # Build a new game
    $deck = build_deck();
    shuffle($deck);

    $playerHand = [];
    $dealerHand = [];

    # Deal two cards to player, and to the dealer
    $playerHand = deal_to_player($playerHand, 2);
    $dealerHand = deal_to_player($dealerHand, 2);

    # Calculate sum of cards
    $playerTotal = calculate_total($playerHand);
    $dealerTotal = calculate_total($dealerHand);

    # Check to see if either player or dealer were dealt blackjack
    if (($playerTotal==21) and ($dealerTotal==21)){
        
        # Player and dealer were both dealt blackjack. Player wins
        $winner = 'player';
    } elseif (($dealerTotal==21) and !($playerTotal==21)){
        
        # Dealer was dealt blackjack
        $winner = 'dealer';
    } elseif (!($dealerTotal==21) and ($playerTotal==21)){
        
        # Player was dealt blackjack
        $winner = 'player';
    }

    # Persist the results for process.php
    $_SESSION['results'] = [
        'deck' => $deck,
        'playerHand' => $playerHand,
        'dealerHand' => $dealerHand,
        'playerTotal' => $playerTotal,
        'dealerTotal' => $dealerTotal,
        'winner' => $winner
    ];
}

require 'index-view.php';