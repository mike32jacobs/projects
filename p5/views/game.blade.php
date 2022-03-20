@extends('templates/master')

@section('title')
    Game Details
@endsection

@section('content')
    <h2>Game Details</h2>
    <img src="/images/hopper.jpg" alt="Grace Murray Hopper" width="25%">
    <ul>
        <li>Game id: {{ $game['id'] }}</li>
        <li>Winning Score: <span test='winning-score'>{{ $game['winning_score'] }}</span></li>
        <li>Max Count: <span test='max-count'>{{ $game['max_count'] }}</span></li>
        <li>Winner: {{ $game['winner'] }}</li>
        <li>Time Stamp: {{ $game['timestamp'] }}</li>

    </ul>

    <h2>Game History: Choice By Choice</h2>
    <table>
        <tr>
            <th>Player ID</th>
            <th>Total Score After Move</th>
            <th>Move (Add how many?)</th>
        </tr>
        <?php
        $i = count($choices) - 1;
        while ($i >= 0) {
            echo '<tr>' . PHP_EOL;
            echo '<td>' . $choices[$i]['player_id'] . '</td>' . PHP_EOL;
            echo '<td>' . $choices[$i]['total'] . '</td>' . PHP_EOL;
            echo '<td>' . $choices[$i]['choice'] . '</td>' . PHP_EOL;
            echo '</tr>' . PHP_EOL;
            $i--;
        }
        ?>
    </table>

    <a href='/history'>Back to game history</a>
@endsection
