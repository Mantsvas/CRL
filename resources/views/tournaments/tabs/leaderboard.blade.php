@if (Auth::user() && Auth::user()->is_admin) 
<div class="m-3">
    <a class="btn btn-info btn-flat" href="{{ route('tournaments.startPlayoff', $tournament) }}">Start Playoffs</a>
</div>
@endif
<x-tournaments.leaderboard :tournament="$tournament" />