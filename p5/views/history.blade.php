@extends('templates/master')

@section('title')
    Game History
@endsection

@section('content')
    <h2 test='history-heading'>Game History</h2>
    <img src="/images/scholnick.jpg" alt="Lewis Scholnick" width="25%">

    @foreach ($games as $game)
        <li class='game-link'><a href='/game?id={{ $game['id'] }}'>{{ $game['timestamp'] }}</a></li>
    @endforeach
    <a href='/'>Home</a>
@endsection
