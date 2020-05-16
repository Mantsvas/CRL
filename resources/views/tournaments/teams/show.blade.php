@extends('layouts.app')

@section('content')
    
    <a href="{{ route('tournaments.show', $team->tournament_id) }}" ><x-headings.small :heading="$team->tournament->title" /></a>
    <x-cards.responsive-card :cardTitle="__('messages.Squad')  . ' (' . $team->title .')'" >
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    @foreach ($team->players as $player)     
                        <tr>
                            <td><a href="https://royaleapi.com/player/{{ $player->fixedTag() }}" >{{ $player->name }}</a></td>
                            <td>PB: {{ $player->max_trophies }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-cards.responsive-card>

    <div class="my-2">
        @include('adsense.top_horizontal')
    </div>

    <x-cards.responsive-card :cardTitle="__('messages.Schedule')  . ' (' . $team->title .')'" >
        <div class="table-responsive">
            <table class="table table-hover">
                <thead></thead>
                <tbody>
                    @foreach($team->games->sortBy('round') as $game)
                        <tr> 
                            <td>
                                {{ $game->round }}. {{ __('messages.Round') }}
                                @if ($game->winner_id == $team->id && $game->winner_id != null)
                                    <img src="/storage/images/winLogo.png" style="width: 15px" />
                                @elseif ($game->winner_id != null)
                                    <img src="/storage/images/loseLogo.png" style="width: 15px" />
                                @endif
                            </td>
                            <td>VS <a href="{{ route('tournaments.team.show', $game->home_team_id == $team->id ? $game->away_team_id : $game->home_team_id) }}">{{ $game->home_team_id == $team->id ? $game->awayTeam->title : $game->homeTeam->title }}</a></td>
                            <td>{{ $game->home_team_id == $team->id ? $game->home_team_score . ' - ' . $game->away_team_score : $game->away_team_score . ' - ' . $game->home_team_score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-cards.responsive-card>


@endsection