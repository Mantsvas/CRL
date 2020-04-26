@include('tournaments.forms.clans_registration')
<hr>
<x-tournaments.sponsors :tournament="$tournament"/>
<hr>
@include('tournaments.lists.participiants', ['tournament' => $tournament])