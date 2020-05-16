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
                        <tr>
                            <td><a href="{{ route('tournaments.team.show', $team->id) }}">{{ $loop->index + 1 . '. ' . $team->title }}</a></td>
                            <td>{{ $team->wins }}</td>
                            <td>{{ $team->loses }}</td>
                            <td>{{ $team->score . ' / ' . $team->score_against }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-cards.responsive-card>
@endforeach