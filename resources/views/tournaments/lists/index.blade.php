<div class="table-responsive">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th class="min"></th>
                <th>Pavadinimas</th>
                <th>Registracijos pabaiga</th>
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
                                <button type="submit">Ištrinti</button>
                            </form>
                        @else
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