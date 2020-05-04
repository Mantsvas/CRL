@extends('layouts.app')

@section('content')
    <div class="gameDetails">
        <form action="{{ route('tournaments.gameDetails.store', $game) }}" method="post">
            @csrf
            <x-headings.medium heading="2vs2" />
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <h5 class="col-12 text-center">{{ $game->homeTeam->title }}</h5>
                        <div class="col-12 col-md-4">
                            <x-inputs.select name="2vs2[home_team_player_1]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                        <div class="col-12 col-md-4">
                            <x-inputs.select name="2vs2[home_team_player_2]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="row">
                        <h5 class="col-12 text-center">{{ $game->awayTeam->title }}</h5>
                        <div class="col-12 col-md-4 offset-md-4">
                            <x-inputs.select name="2vs2[away_team_player_1]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                        <div class="col-12 col-md-4">
                            <x-inputs.select name="2vs2[away_team_player_2]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-4 order-md-2 text-center">
                            <x-headings.small :heading="__('messages.1st match')"  />
                        </div>
                        <div class="col-6 col-md-4 order-md-1">
                            <x-inputs.numeric name="2vs2[game_1][homeScore]" />
                        </div>
                        <div class="col-6 col-md-4 order-md-3">
                            <x-inputs.numeric name="2vs2[game_1][awayScore]" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 order-md-2 text-center">
                            <x-headings.small :heading="__('messages.2nd match')"  />
                        </div>
                        <div class="col-6 col-md-4 order-md-1">
                            <x-inputs.numeric name="2vs2[game_2][homeScore]" />
                        </div>
                        <div class="col-6 col-md-4 order-md-3">
                            <x-inputs.numeric name="2vs2[game_2][awayScore]" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 order-md-2 text-center">
                            <x-headings.small :heading="__('messages.3rd match')"  />
                        </div>
                        <div class="col-6 col-md-4 order-md-1">
                            <x-inputs.numeric name="2vs2[game_3][homeScore]" />
                        </div>
                        <div class="col-6 col-md-4 order-md-3">
                            <x-inputs.numeric name="2vs2[game_3][awayScore]" />
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <x-headings.medium heading="KOTH" />
            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.1st match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="KOTH[game_1][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="KOTH[game_1][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="KOTH[game_1][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="KOTH[game_1][awayScore]" />
                </div>
            </div>

            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.2nd match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="KOTH[game_2][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="KOTH[game_2][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="KOTH[game_2][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="KOTH[game_2][awayScore]" />
                </div>
            </div>

            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.3rd match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="KOTH[game_3][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="KOTH[game_3][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="KOTH[game_3][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="KOTH[game_3][awayScore]" />
                </div>
            </div>

            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.4th match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="KOTH[game_4][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="KOTH[game_4][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="KOTH[game_4][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="KOTH[game_4][awayScore]" />
                </div>
            </div>

            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.5th match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="KOTH[game_5][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="KOTH[game_5][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="KOTH[game_5][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="KOTH[game_5][awayScore]" />
                </div>
            </div>

            <hr>
            <x-headings.medium :heading="__('messages.Overtime')" />
            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.1st match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="overtime[game_1][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="overtime[game_1][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="overtime[game_1][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="overtime[game_1][awayScore]" />
                </div>
            </div>

            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.2nd match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="overtime[game_2][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="overtime[game_2][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')" />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="overtime[game_2][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="overtime[game_2][awayScore]" />
                </div>
            </div>

            <div class="row">
                <div class="col-12  order-md-1 text-center">
                    <x-headings.small :heading="__('messages.3rd match')"  />
                </div>
                <div class="col-6 col-md-3 order-md-2">
                    <x-inputs.select name="overtime[game_3][home_team_player]" :options="$game->homeTeam->players->pluck('name', 'id')->prepend('', '')"  />
                </div>
                <div class="col-6 col-md-3  order-md-5">
                    <x-inputs.select name="overtime[game_3][away_team_player]" :options="$game->awayTeam->players->pluck('name', 'id')->prepend('', '')"  />
                </div>
                <div class="col-6 col-md-3  order-md-3">
                    <x-inputs.numeric name="overtime[game_3][homeScore]" />
                </div>
                <div class="col-6 col-md-3  order-md-4">
                    <x-inputs.numeric name="overtime[game_3][awayScore]" />
                </div>
            </div>
            <x-buttons.submit_button :name="__('messages.Submit score')" />
        </form>
    </div>

@endsection
