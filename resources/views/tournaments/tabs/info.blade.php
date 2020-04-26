@include('tournaments.lists.basic_info', ['tournament' => $tournament])
<hr>
<x-tournaments.sponsors :tournament="$tournament" />
<hr>
@include('tournaments.lists.moderators', ['tournament' => $tournament, 'users' => $users])

