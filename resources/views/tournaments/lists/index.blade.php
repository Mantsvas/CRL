<div class="table-responsive">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                @if (Auth::user() && Auth::user()->is_admin)
                    <th class="min"></th>
                @endif
                <th>Pavadinimas</th>
                <th>Registracijos pabaiga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tournaments as $tournament)
                <tr>
                    @if (Auth::user() && Auth::user()->is_admin)
                        <td class="min">
                            <form action="{{ route('tournaments.destroy', $tournament) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Ištrinti</button>
                            </form>
                        </td>
                    @endif
                    <td><a href="{{ route('tournaments.show', $tournament) }}">{{ $tournament->title }}</a></td>
                    <td>{{ $tournament->start_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>