<section id="bracket">
    <div class="container">
        <div class="split split-one">
            <div class="round round-one current">
                <div class="round-details">{{ __('messages.Quaterfinal') }}<br/><span class="date"></span></div>
                @foreach ($quaterFinals as $game)
                    <ul class="matchup">
                        <li class="team team-top">
                            @if ($game->winner_id != null && $game->winner_id == $game->home_team_id)
                                <strong>
                            @endif
                            {{ $game->homeTeam->title ?? null }}
                            <span class="score">
                                {{ $game->home_team_score }}
                                @if ($tournament->canModerate() && isset($game->home_team_id) && isset($game->away_team_id))
                                    <a class="btn btn-flat btn-sm btn-info" href="{{ route('tournaments.gameDetails.edit', $game) }}" ><i class="fa fa-edit"></i></a>
                                @endif
                            </span>
                            @if ($game->winner_id != null && $game->winner_id == $game->home_team_id)
                                </strong>
                            @endif
                        </li>
                        <li class="team team-bottom">
                            @if ($game->winner_id != null && $game->winner_id == $game->away_team_id)
                                <strong>
                            @endif
                            {{ $game->awayTeam->title ?? null }}
                            <span class="score">
                                {{ $game->away_team_score }}
                                @if ($tournament->canModerate() && isset($game->home_team_id) && isset($game->away_team_id))
                                    <a class="btn btn-flat btn-sm btn-info" href="{{ route('tournaments.gameDetails.edit', $game) }}" ><i class="fa fa-edit"></i></a>
                                @endif
                            </span>
                            @if ($game->winner_id != null && $game->winner_id == $game->away_team_id)
                                </strong>
                            @endif
                        </li>
                    </ul>
                @endforeach                                   
            </div>  <!-- END ROUND ONE -->

            <div class="round round-two current">
                <div class="round-details">{{ __('messages.Semifinal') }}<br/><span class="date"></span></div>         
                @foreach ($semiFinals as $game)
                    <ul class="matchup">
                        <li class="team team-top">
                            @if ($game->winner_id != null && $game->winner_id == $game->home_team_id)
                                <strong>
                            @endif
                            {{ $game->homeTeam->title ?? null }}
                            <span class="score">
                                {{ $game->home_team_score }}
                                @if ($tournament->canModerate() && isset($game->home_team_id) && isset($game->away_team_id))
                                    <a class="btn btn-flat btn-sm btn-info" href="{{ route('tournaments.gameDetails.edit', $game) }}" ><i class="fa fa-edit"></i></a>
                                @endif
                            </span>
                            @if ($game->winner_id != null && $game->winner_id == $game->home_team_id)
                                </strong>
                            @endif
                        </li>
                        <li class="team team-bottom">
                            @if ($game->winner_id != null && $game->winner_id == $game->away_team_id)
                                <strong>
                            @endif
                            {{ $game->awayTeam->title ?? null }}
                            <span class="score">
                                {{ $game->away_team_score }}
                                @if ($tournament->canModerate() && isset($game->home_team_id) && isset($game->away_team_id))
                                    <a class="btn btn-flat btn-sm btn-info" href="{{ route('tournaments.gameDetails.edit', $game) }}" ><i class="fa fa-edit"></i></a>
                                @endif
                            </span>
                            @if ($game->winner_id != null && $game->winner_id == $game->away_team_id)
                                </strong>
                            @endif
                        </li>
                    </ul>
                @endforeach                                     
            </div>  <!-- END ROUND TWO -->
        </div> 

        <div class="champion">
            <div class="final current">
                <i class="fa fa-trophy"></i>
                <div class="round-details">{{ __('messages.Final') }}<br/><span class="date"></span></div>      
                @foreach ($finals as $game)
                    <ul class="matchup">
                        <li class="team team-top">
                            @if ($game->winner_id != null && $game->winner_id == $game->home_team_id)
                                <strong>
                            @endif
                            {{ $game->homeTeam->title ?? null }}
                            <span class="score">
                                {{ $game->home_team_score }}
                                @if ($tournament->canModerate() && isset($game->home_team_id) && isset($game->away_team_id))
                                    <a class="btn btn-flat btn-sm btn-info" href="{{ route('tournaments.gameDetails.edit', $game) }}" ><i class="fa fa-edit"></i></a>
                                @endif
                            </span>
                            @if ($game->winner_id != null && $game->winner_id == $game->home_team_id)
                                </strong>
                            @endif
                        </li>
                        <li class="team team-bottom">
                            @if ($game->winner_id != null && $game->winner_id == $game->away_team_id)
                                <strong>
                            @endif
                            {{ $game->awayTeam->title ?? null }}
                            <span class="score">
                                {{ $game->away_team_score }}
                                @if ($tournament->canModerate() && isset($game->home_team_id) && isset($game->away_team_id))
                                    <a class="btn btn-flat btn-sm btn-info" href="{{ route('tournaments.gameDetails.edit', $game) }}" ><i class="fa fa-edit"></i></a>
                                @endif
                            </span>
                            @if ($game->winner_id != null && $game->winner_id == $game->away_team_id)
                                </strong>
                            @endif
                        </li>
                    </ul>
                @endforeach    
            </div>
        </div>

    </div>
</section>
   