<x-cards.responsive-card :cardTitle="__('messages.2vs2 ranking')" contentClasses="p-0">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('messages.Player') }}</th>
                    <th>{{ __('messages.Team') }}</th>
                    <th>{{ __('messages.Played') }}</th>
                    <th>{{ __('messages.Wins') }}</th>
                    <th>{{ __('messages.Crowns') }}</th>
                    <th>{{ __('messages.Win %') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankingByWins2vs2 as $player)   
                    <tr>
                        <td><a href="https://royaleapi.com/player/{{ $player['player']->fixedTag() }}" >{{ $loop->index + 1 . '. ' . $player['player']->name }}</a></td>
                        <td>
                            @if (isset($player['team']))
                                <a href="{{ route('tournaments.team.show', $player['team']->id) }}">{{ $player['team']->title }}</a>
                            @endif
                        </td>
                        <td>{{ $player['played'] }}</td>
                        <td>{{ $player['won'] }}</td>
                        <td>{{ $player['crowsCollected'] . ' / ' .  $player['crowsLost'] }}</td>
                        <td>{{ number_format((float)$player['winPercent'], 2, '.', '') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-cards.responsive-card>

<div class="m-2">
    @include('adsense.top_horizontal')
</div>

<x-cards.responsive-card :cardTitle="__('messages.1vs1 ranking')" contentClasses="p-0">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('messages.Player') }}</th>
                    <th>{{ __('messages.Team') }}</th>
                    <th>{{ __('messages.Played') }}</th>
                    <th>{{ __('messages.Wins') }}</th>
                    <th>{{ __('messages.Crowns') }}</th>
                    <th>{{ __('messages.Win %') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankingByWinsKOTH as $player)   
                    <tr>
                        <td><a href="https://royaleapi.com/player/{{ $player['player']->fixedTag() }}" >{{ $loop->index + 1 . '. ' . $player['player']->name }}</a></td>
                        <td>
                            @if (isset($player['team']))
                                <a href="{{ route('tournaments.team.show', $player['team']->id) }}">{{ $player['team']->title }}</a>
                            @endif
                        </td>
                        <td>{{ $player['played'] }}</td>
                        <td>{{ $player['won'] }}</td>
                        <td>{{ $player['crowsCollected'] . ' / ' .  $player['crowsLost'] }}</td>
                        <td>{{ number_format((float)$player['winPercent'], 2, '.', '') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-cards.responsive-card>