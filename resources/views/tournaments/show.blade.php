@extends('layouts.app')

@section('content')

    <x-headings.large :heading="$tournament->title" />

    @include('layouts.errors')

    <x-tabs.tab :active="$activeTab" :tabs="$tournament->tabs()">

        @if ($tournament->stage == 'preparation')

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
            <x-tournaments.rules :tournament="$tournament" />
        </x-tabs.content>
        
    </x-tabs.tab>

@endsection

@section('script')

    <script>
        function toggleTeam(teamId) {
            let isHidden = $('.mainTeam' + teamId).hasClass('hidden');
            if (isHidden) {
                $('.mainTeam' + teamId).removeClass('hidden').addClass('visible')
                $('.hidden_' + teamId).toggle('slow');
            } else {
                $('.hidden_' + teamId).toggle('slow');
                $('.mainTeam' + teamId).removeClass('visible').addClass('hidden')
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
