@extends('layouts.app')

@section('content')

    @if ($tournament->canModerate())
        <a class="btn btn-flat btn-info m-2" href="{{ route('tournaments.edit', $tournament) }}"><i class="fa fa-edit"></i></a>
    @endif
    <x-headings.large :heading="$tournament->title" />

    @include('layouts.errors')

    <x-tabs.tab :active="$activeTab" :tabs="$tournament->tabs()" :tournament="$tournament" />

        {{-- @if ($tournament->stage == 'preparation')

            <x-tabs.content :active="$activeTab" key="info">
                <x-cards.responsive-card>
                    @include('tournaments.tabs.info')
                </x-cards.responsive-card>
            </x-tabs.content>

            <x-tabs.content :active="$activeTab" key="players">
                <x-cards.responsive-card>
                    @include('tournaments.tabs.players')
                </x-cards.responsive-card>
            </x-tabs.content>

        @else
        
            <x-tabs.content :active="$activeTab" key="info">
                <x-cards.responsive-card>
                    @include('tournaments.tabs.info')
                </x-cards.responsive-card>
            </x-tabs.content>

            <x-tabs.content :active="$activeTab" key="players">
                <x-tournaments.leaderboard :tournament="$tournament" />
            </x-tabs.content>

            <x-tabs.content :active="$activeTab" key="schedule">
                <x-tournaments.schedule :tournament="$tournament" />
            </x-tabs.content>

        @endif
        <x-tabs.content :active="$activeTab" key="rules">
            <x-cards.responsive-card>
                <x-tournaments.rules :tournament="$tournament" />
            </x-cards.responsive-card>
        </x-tabs.content>
        
    </x-tabs.tab> --}}

    <x-tabs.content :active="$activeTab" :key="$activeTab">
        <x-cards.responsive-card>
            @include('tournaments.tabs.' . $activeTab)
        </x-cards.responsive-card>
    </x-tabs.content>

@endsection

@section('script')

    <script>
        var actionActivated = false;
        function toggleTeam(teamId) {
            if (!actionActivated) {
                actionActivated = true;

                let isHidden = $('.mainTeam' + teamId).hasClass('hidden');
                if (isHidden) {
                    $('.mainTeam' + teamId).removeClass('hidden').addClass('visible');
                    $('.hidden_' + teamId).toggle('slow');
                } else {
                    $('.hidden_' + teamId).toggle('slow');
                    $('.mainTeam' + teamId).removeClass('visible').addClass('hidden');
                }
                actionActivated = false;
            }
        }

        function toggleSquad(squadId) {
            if (!actionActivated) {
                actionActivated = true;
                let isHidden = $('.mainSquad' + squadId).hasClass('hidden');
                if (isHidden) {
                    $('.mainSquad' + squadId).removeClass('hidden').addClass('visible');
                    $('.squad_' + squadId).toggle('slow');
                } else {
                    $('.squad_' + squadId).toggle('slow');
                    $('.mainSquad' + squadId).removeClass('visible').addClass('hidden');
                }
                actionActivated = false;
            }
        }
    </script>

    @if ($tournament->canModerate()) 
        <script>
            function setGameResult(gameId) {
                let homeScore = $('#homeResultGame_' + gameId).val();
                let awayScore = $('#awayResultGame_' + gameId).val();
                if (homeScore == awayScore) {
                    generateMsg('danger', '{{__('messages.Result cant be a draw!')}}')
                } else {
                    clearMsg();

                    let postData = {
                        _token: $('input[name=_token]').val(),
                        home_team_score: homeScore,
                        away_team_score: awayScore,
                        game_id: gameId
                    };
                    $.ajax({
                        url: '{{route('ajax.tournaments.setGameResult')}}',
                        type: 'post',
                        dataType: 'json',
                        data: postData,
                        success: function (data) {
                            gameResultSuccess(data);
                        },
                        error: function (error) {
                            gameResultError(error);
                        }
                    })
                }
            }

            function gameResultSuccess(data) {
                if (data.success) {
                    console.log(data.success)
                    location.reload();
                } else {
                    generateMsg('danger', data.error)
                }
            }

            function gameResultError(error) {
                console.log(error);
            }
        </script>
    @endif
@endsection
