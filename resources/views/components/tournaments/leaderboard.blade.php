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
                        <tr class="hidden mainTeam{{$team->id}}" onclick="toggleTeam({{ $team->id }})">
                            <td>{{ $loop->index + 1 . '. ' . $team->title }}</td>
                            <td>{{ $team->wins }}</td>
                            <td>{{ $team->loses }}</td>
                            <td>{{ $team->score . ' / ' . $team->score_against }}</td>
                        </tr>
                        @foreach($team->games->sortBy('round') as $game)
                            <tr class="hidden_{{$team->id}} d-none" style="background-color: #17a2b8"> 
                                <td></td>
                                <td>
                                    {{ $game->round }}. {{ __('messages.Round') }}
                                    @if ($game->winner_id == $team->id && $game->winner_id != null)
                                        <img src="/storage/images/winLogo.png" style="width: 15px" />
                                    @elseif ($game->winner_id != null)
                                        <img src="/storage/images/loseLogo.png" style="width: 15px" />
                                    @endif
                                </td>
                                <td>VS {{ $game->home_team_id == $team->id ? $game->awayTeam->title : $game->homeTeam->title }}</td>
                                <td>{{ $game->home_team_id == $team->id ? $game->home_team_score . ' - ' . $game->away_team_score : $game->away_team_score . ' - ' . $game->home_team_score }}</td>
                            </tr>
                        @endforeach

                    @endforeach
                </tbody>
            </table>
        </div>
    </x-cards.responsive-card>
@endforeach