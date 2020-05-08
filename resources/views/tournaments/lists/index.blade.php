<div class="table-responsive">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th class="min"></th>
                <th>{{ __('messages.Title') }}</th>
                <th>{{ __('messages.Registration ends') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tournaments as $tournament)
                <tr>
                    <td class="min">
                        @if (Auth::user() && Auth::user()->is_admin)
                            <form action="{{ route('tournaments.destroy', $tournament) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ __('messages.Delete') }}</button>
                            </form>
                        @elseif ($tournament->stage == 'preparation')
                            <x-buttons.redirect-button :route="route('tournaments.show', ['tournament' => $tournament, 'activeTab' => 'players'])" :name="__('messages.Sign up')" />
                        @endif
                    </td>
                    <td><a href="{{ route('tournaments.show', $tournament) }}">{{ $tournament->title }}</a></td>
                    <td>{{ $tournament->start_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>