@if (Auth::user() && (Auth::user()->is_admin || $tournament->canModerate()))
    <div class="row mb-2">
        <div class="col-12 col-md-3">
            <x-buttons.redirect-button :name="__('messages.Start tournament')" :route="route('tournaments.start', $tournament)"/>
        </div>
    </div>
@endif
<div class="mt-4 table-responsive">
    <x-headings.small :heading="__('messages.Participiants') .' ' . count($tournament->applicants->where('confirmed', true)) . '/' . $tournament->max_participiants" />


    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ __('messages.Team title') }}</th>
                <th class="min">{{ __('messages.Registration status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tournament->applicants as $team)
                <tr style="background-color: {{ $team->deleted_at != null ? '#FFCCCB' : ($team->confirmed ? '#90EE90' : '')}}" >
                    <td style="cursor:pointer;" class="mainSquad_{{ $team->id }} hidden" onclick="toggleSquad({{ $team->id }})"><div class="m-2">{{ $loop->index + 1 . '. ' . $team->title }}</div></td>
                    <td>
                        <div class="mb-2">{{ $team->getStatus() }}</div>
    
                        @if ($tournament->canModerate() && !$team->confirmed && $team->deleted_at == null)
                            @if (count($tournament->teams) < $tournament->max_participiants)
                                <div class="mb-2">
                                    <x-buttons.redirect-button :name="__('messages.Approve')" :route="route('tournaments.approveTeam', $team)" type="success" />
                                </div>
                            @endif
                            <div class="mb-2">
                                <form action="{{ route('tournaments.rejectTeam', $team) }}" method="post">
                                    @csrf
                                    @method('DELETE')
    
                                    <x-buttons.submit-button :name="__('messages.Reject')" type="danger" />
                                </form>
                            </div>
                        @elseif ($tournament->canModerate() && $team->confirmed)
                            <div class="mb-2">
                                <x-buttons.redirect-button :name="__('messages.Remove')" :route="route('tournaments.removeTeam', $team)" type="danger" />
                            </div>
                        @endif
                    </td>
                </tr>
                @foreach($team->players as $player)
                    <tr class="squad_{{ $team->id }}" style="display:none">
                        <td colspan="2">
                            <a href="https://royaleapi.com/player/{{ $player->tag }}">{{ $loop->index + 1 }}. {{ $player->name }}</a>
                        </td>
                    </tr>
                @endforeach 
            @endforeach
        </tbody>
    </table>
</div>