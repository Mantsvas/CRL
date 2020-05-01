@php ($round = 0) 
@foreach($schedule as $round => $groups)
    <x-cards.responsive_card :cardTitle="$round . ' ' . __('messages.Round')" contentClasses="p-0" >
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group => $games)
                        <tr style="background-color: #39cccc">
                            <td colspan="5">{{ $group . ' ' . __('messages.Group') }}</td>
                        </tr>
                        @foreach($games as $game)
                            <tr>
                                <td>
                                    {{ $game->homeTeam->title }}
                                    @if ($game->winner_id == $game->homeTeam->id && $game->winner_id != null)
                                        <img src="/storage/images/winLogo.png" style="width: 15px" />
                                    @endif
                                </td>
                                <td>{{ isset($game->home_team_score) ? $game->home_team_score : ' ' }}</td>
                                <td>VS</td>
                                <td>{{ isset($game->away_team_score) ? $game->away_team_score : ' ' }}</td>
                                <td>
                                    @if ($game->winner_id == $game->awayTeam->id && $game->winner_id != null)
                                        <img src="/storage/images/winLogo.png" style="width: 15px" />
                                    @endif
                                    {{ $game->awayTeam->title }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-cards.responsive_card>
@endforeach