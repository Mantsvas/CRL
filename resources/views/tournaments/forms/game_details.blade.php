@extends('layouts.app')

@section('content')
<x-cards.responsive_card cardTitle="GameDetails" >
    <div class="gameDetails">
        <form action="{{ route('tournaments.gameDetails.store', $game) }}" method="post">
            @csrf
            <x-headings.medium heading="2vs2" />
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <h5 class="col-12 text-center">{{ $game->homeTeam->title }}</h5>
                        <div class="col-12 col-md-4">
                            <x-inputs.select name="2vs2[home_team_player_1]" :selected="$gameDetails['2vs2']['homePlayer1']" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                        <div class="col-12 col-md-4">
                            <x-inputs.select name="2vs2[home_team_player_2]" :selected="$gameDetails['2vs2']['homePlayer2']" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="row">
                        <h5 class="col-12 text-center">{{ $game->awayTeam->title }}</h5>
                        <div class="col-12 col-md-4 offset-md-4">
                            <x-inputs.select name="2vs2[away_team_player_1]" :selected="$gameDetails['2vs2']['awayPlayer1']" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                        <div class="col-12 col-md-4">
                            <x-inputs.select name="2vs2[away_team_player_2]" :selected="$gameDetails['2vs2']['awayPlayer2']" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                    </div>
                </div>
            </div>
            @php($title = [1 => '1st', 2 => '2nd', 3 => '3rd', 4 => '4th', 5 => '5th'])

            <div class="row">
                <div class="col-12">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="row">
                            <div class="col-12 col-md-4 order-md-2 text-center">
                                <x-headings.small :heading="__('messages.' . $title[$i] . ' match')"  />
                            </div>
                            <div class="col-6 col-md-4 order-md-1">
                                <x-inputs.numeric :name="'2vs2[game_' . $i . '][homeScore]'" :value="$gameDetails['2vs2']['game' . $i]['homeScore'] ?? null" />
                            </div>
                            <div class="col-6 col-md-4 order-md-3">
                                <x-inputs.numeric :name="'2vs2[game_' . $i . '][awayScore]'" :value="$gameDetails['2vs2']['game' . $i]['awayScore'] ?? null" />
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <hr>
            <x-headings.medium heading="KOTH" />
            @for ($i = 1; $i <= 5; $i++)
                <div class="row">
                    <div class="col-12  order-md-1 text-center">
                        <x-headings.small :heading="__('messages.' . $title[$i] . ' match')"  />
                    </div>
                    <div class="col-6 col-md-3 order-md-2">
                        <x-inputs.select :name="'KOTH[game_' . $i . '][home_team_player]'" :selected="$gameDetails['KOTH']['game' . $i]['homePlayer'] ?? null" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                    </div>
                    <div class="col-6 col-md-3  order-md-5">
                        <x-inputs.select :name="'KOTH[game_' . $i . '][away_team_player]'" :selected="$gameDetails['KOTH']['game' . $i]['awayPlayer'] ?? null" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                    </div>
                    <div class="col-6 col-md-3  order-md-3">
                        <x-inputs.numeric :name="'KOTH[game_' . $i . '][homeScore]'" :value="$gameDetails['KOTH']['game' . $i]['homeScore'] ?? null" />
                    </div>
                    <div class="col-6 col-md-3  order-md-4">
                        <x-inputs.numeric :name="'KOTH[game_' . $i . '][awayScore]'" :value="$gameDetails['KOTH']['game' . $i]['awayScore'] ?? null" />
                    </div>
                </div>
            @endfor

            <hr>
            <x-headings.medium :heading="__('messages.Overtime')" />
            @for ($i = 1; $i <= 3; $i++)
                <div class="row">
                    <div class="col-12  order-md-1 text-center">
                        <x-headings.small :heading="__('messages.' . $title[$i] . ' match')"  />
                    </div>
                    <div class="col-6 col-md-3 order-md-2">
                        <x-inputs.select :name="'overtime[game_' . $i . '][home_team_player]'" :selected="$gameDetails['1vs1']['game' . $i]['homePlayer'] ?? null" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                    </div>
                    <div class="col-6 col-md-3  order-md-5">
                        <x-inputs.select :name="'overtime[game_' . $i . '][away_team_player]'" :selected="$gameDetails['1vs1']['game' . $i]['awayPlayer'] ?? null" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                    </div>
                    <div class="col-6 col-md-3  order-md-3">
                        <x-inputs.numeric :name="'overtime[game_' . $i . '][homeScore]'" :value="$gameDetails['1vs1']['game' . $i]['homeScore'] ?? null" />
                    </div>
                    <div class="col-6 col-md-3  order-md-4">
                        <x-inputs.numeric :name="'overtime[game_' . $i . '][awayScore]'" :value="$gameDetails['1vs1']['game' . $i]['awayScore'] ?? null" />
                    </div>
                </div>
            @endfor

            <x-buttons.submit_button :name="__('messages.Submit score')" />
        </form>
    </div>
</x-cards.responsive_card>
@endsection
