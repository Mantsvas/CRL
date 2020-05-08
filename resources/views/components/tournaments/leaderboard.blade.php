@foreach ($leaderboard as $group => $teams)
    <x-cards.responsive-card :cardTitle="__('messages.Group') . ' ' .$group" contentClasses="p-0">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('messages.Team') }}</th>
                        <th>{{ __('messages.Wins') }}</th>
                        <th>{{ __('messages.Loses') }}</th>
                        <th>{{ __('messages.Points') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)     
                        <tr class="hidden mainTeam{{$team->id}}" onclick="toggleTeam({{ $team->id }})" style="cursor:pointer">
                            <td>{{ $loop->index + 1 . '. ' . $team->title }}</td>
                            <td>{{ $team->wins }}</td>
                            <td>{{ $team->loses }}</td>
                            <td>{{ $team->score . ' / ' . $team->score_against }}</td>
                        </tr>
                        @foreach($team->games->sortBy('round') as $game)
                            <tr class="hidden_{{$team->id}}" style="display: none"> 
                                <td></td>
                                <td style="background-color: #17a2b8" colspan="2">
                                    {{ $game->round }}. {{ __('messages.Round') }}
                                    VS {{ $game->home_team_id == $team->id ? $game->awayTeam->title : $game->homeTeam->title }}
                                    @if ($game->winner_id == $team->id && $game->winner_id != null)
                                        <img src="/storage/images/winLogo.png" style="width: 15px" />
                                    @elseif ($game->winner_id != null)
                                        <img src="/storage/images/loseLogo.png" style="width: 15px" />
                                    @endif
                                </td>
                                <td style="background-color: #17a2b8">{{ $game->home_team_id == $team->id ? $game->home_team_score . ' - ' . $game->away_team_score : $game->away_team_score . ' - ' . $game->home_team_score }}</td>
                            </tr>
                        @endforeach

                    @endforeach
                </tbody>
            </table>
        </div>
    </x-cards.responsive-card>
@endforeach