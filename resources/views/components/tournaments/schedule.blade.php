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
                        @if ($tournament->canModerate())
                        <th class="min"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @csrf
                    @foreach($groups as $group => $games)
                        <tr style="background-color: #39cccc">
                            <td colspan="{{$tournament->canModerate() ? 6 : 5 }}">{{ $group . ' ' . __('messages.Group') }}</td>
                        </tr>
                        @foreach($games as $game)
                            <tr>
                                <td>
                                    {{ $game->homeTeam->title }}
                                    @if ($game->winner_id == $game->homeTeam->id && $game->winner_id != null)
                                        <img src="/storage/images/winLogo.png" style="width: 15px" />
                                    @elseif ($game->winner_id != null)
                                        <img src="/storage/images/loseLogo.png" style="width: 15px" />
                                    @endif
                                </td>
                                <td>
                                    {{ isset($game->home_team_score) ? $game->home_team_score : ' ' }}
                                    @if ($tournament->canModerate() && ($game->home_team_id && $game->away_team_id))
                                        <input id="homeResultGame_{{ $game->id }}" type="number" step="1" min="0" max="2" style="max-width: 50px">
                                    @endif
                                </td>
                                <td>Vs</td>
                                <td>
                                    @if ($tournament->canModerate() && ($game->home_team_id && $game->away_team_id))
                                        <input id="awayResultGame_{{ $game->id }}" type="number" step="1" min="0" max="2" style="max-width: 50px">
                                    @endif
                                    {{ isset($game->away_team_score) ? $game->away_team_score : ' ' }}
                                </td>
                                <td>
                                    @if ($game->winner_id == $game->awayTeam->id && $game->winner_id != null)
                                        <img src="/storage/images/winLogo.png" style="width: 15px" />
                                    @elseif ($game->winner_id != null)
                                        <img src="/storage/images/loseLogo.png" style="width: 15px" />
                                    @endif
                                    {{ $game->awayTeam->title }}
                                </td>
                                @if ($tournament->canModerate())
                                    <td class="min">
                                        @if ($game->home_team_id && $game->away_team_id)
                                            <button class="btn btn-flat btn-sm btn-success" onclick="setGameResult({{$game->id}})"><i class="fa fa-save"></i></button>
                                            {{-- <a class="btn btn-flat btn-sm btn-info" href="{{ route('tournaments.gameDetails.edit', $game) }}" ><i class="fa fa-edit"></i></a> --}}
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-cards.responsive_card>
@endforeach