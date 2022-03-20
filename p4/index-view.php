<!doctype html>
<html lang='en'>

<head>
    <title>Project 2: BlackJack</title>
    <meta charset='utf-8'>
    <link href=data: , rel=icon>
    <style>
    table {
        width: 100%
    }

    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 15px;
        text-align: center;
        vertical-align: middle;
    }

    tr:nth-child(even) {
        background-color: #D6EEEE;
    }
    </style>
</head>

<body>
    <h1>Project 2: Blackjack - By Michael Jacobs</h1>
    <div>
        <h2>Instructions</h2>
        <p>The purpose of the game is to get a hand which has a value of 21. </p>
        <ul>
            <li>You are initially dealt two cards </li>
            <li>You can choose to "stay" or to "hit." </li>
            <li>To "hit" means that you will be dealt another card. </li>
            <li>To "stay" means that you decide that your turn is over, and the dealer can go. </li>
            <li> The dealer has to hit on any value less than 16.</li>
        </ul>
        <div>
            <h2>Dealer's Hand</h2>
            <table>
                <tr>
                    <?php foreach ($dealerHand as $cardNumber => $card) { ?>
                    <th>Card <?php echo $cardNumber + 1 ?>
                    </th>
                    <?php } ?>
                    <th>Total</th>
                </tr>
                <tr>
                    <?php foreach ($dealerHand as $card) { ?>
                    <td><?php echo $card[0].' '.$card[1] ?>
                    </td>
                    <?php } ?>

                    <td><?php echo $dealerTotal; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <h2>Player's Hand</h2>
            <table>
                <tr>
                    <?php foreach ($playerHand as $cardNumber => $card) { ?>
                    <th>Card <?php echo $cardNumber + 1 ?>
                    </th>
                    <?php } ?>
                    <th>Total</th>
                </tr>
                <tr>
                    <?php foreach ($playerHand as $cardNumber => $card) { ?>
                    <td><?php echo $card[0].' '.$card[1] ?>
                    </td>
                    <?php } ?>

                    <td><?php echo $playerTotal; ?>
                    </td>
                </tr>
            </table>
        </div>

        <?php if (isset($winner)) { ?>
        <h2>Results</h2>
        <?php if ($winner == 'player') { ?>
        <p>You Win. Your total was <?php echo $playerTotal; ?></p>
        <p>The dealer's total was <?php echo $dealerTotal; ?></p>


        <?php } elseif ($winner == 'dealer') { ?>
        Sorry, you lost. Your total was <?php echo $playerTotal; ?></p>
        <p>The dealer's total was <?php echo $dealerTotal; ?></p>

        <?php } ?>
        <?php }?>

        <?php if (!isset($winner)) { ?>
        <form method='POST' action='process.php'>
            <label for="move">What would you like to do?</label>

            <input type='radio' id="stay" name='move' value="stay" checked><label for='stay'>Stay</label>
            <input type='radio' id="hit" name='move' value="hit"><label for='hit'>Hit</label>

            <button type='submit'>Play</button>
        </form>
        <?php } else { ?>
        <a href='index.php?reset=true'>Play again</a>
        <?php } ?>
</body>

</html>