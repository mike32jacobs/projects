@extends('templates/master')

@if ($app->errorsExist())
    <div test='error-alert' class='alert alert-danger'>Please correct the errors below</div>
@endif

@section('content')

    <h2>Welcome to Project 3: Nerd Count</h2>
    <h3>By: Michael Jacobs</h3>

    <p>This is the final project for DGMD E-2 WEB PROGRAMMING FOR BEGINNERS WITH PHP</p>
    <img src="/images/Urkel.jpg" alt="Steve Urkel" width="25%">

    <h3>Instructions</h3>
    <p>The goal of the game is to be the person to advance the count to the winning number. Each time it is your turn, you
        can advance the
        count by 1 or 2. You will take turns with the Nerd.</p>

    <h3>Start a new game</h3>
    <form method='POST' action='/new'>
        <label for="winning-number">Choose the winning number: It must be greater than 10</label>
        <input type="number" test='winning-number-input' id="winning-number" name="winning-number" min="11">
        <label for="max-count">Choose how much each player can advance the count: It must be greater than 1 and less than
            5</label>
        <input type="number" test='max-count-input' id="max-count" name="max-count" min="2" max="5">
        <button test='submit-button' type='submit'>start a new game!</button>
    </form>

    @if ($app->errorsExist())
        <ul test='error-messages' class='error alert alert-danger'>
            @foreach ($app->errors() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif


@endsection
