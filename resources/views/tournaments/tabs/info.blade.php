@include('tournaments.lists.basic_info', ['tournament' => $tournament])
<hr>
<x-tournaments.sponsors :tournament="$tournament" />
<hr>
@if (Auth::user() && Auth::user()->is_admin)
    @include('tournaments.lists.moderators', ['tournament' => $tournament, 'users' => $users])
@endif

