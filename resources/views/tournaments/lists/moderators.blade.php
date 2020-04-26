<div class="responsive-table">
    <x-headings.small :heading="__('messages.Moderators')" />

    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>{{ __('messages.User') }}</th>
                <th>{{ __('messages.Email') }}</th>
                @if (Auth::user() && Auth::user()->is_admin)
                    <th class="min">
                        <form action="{{ route('tournaments.addModerator') }}" method="post">
                            @csrf
                            <x-inputs.hidden name="tournament_id" :value="$tournament->id" />
                            <x-inputs.select name="user_id" :options="$users"/>
                            <x-buttons.submit_button :name="__('messages.Add')" />
                        </form>
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($tournament->moderators as $moderator)
                    <td>{{ $loop->index + 1 . '. ' . $moderator->name }}</td>
                    <td>{{ $moderator->email }}</td>
                    @if (Auth::user() && Auth::user()->is_admin)
                        <td>
                            <form action="{{ route('tournaments.removeModerator') }}" method="post">
                                @csrf
                                <x-inputs.hidden name="tournament_id" :value="$tournament->id" />
                                <x-inputs.hidden name="user_id" :value="$moderator->id"/>
                                <x-buttons.submit_button type="danger" :name="__('messages.Remove')" />
                            </form>
                        </td>
                    @endif
                @endforeach
            </tr>
        </tbody>
    </table>
</div>