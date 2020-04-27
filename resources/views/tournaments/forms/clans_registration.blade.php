<form action="{{ route('tournaments.registerForTournament') }}" method="post">
    @csrf
    <x-headings.small :heading="__('messages.Registration form')" />

    <x-inputs.hidden name="tournament_id" :value="$tournament->id" />

    {{-- <x-inputs.text :label="__('messages.Clan tag')" name="tag" /> --}}

    <x-inputs.text :label="__('messages.Clan title')" name="title" required="required" />

    <x-headings.extra-small :heading="__('messages.Team members') . ' (' . __('messages.Min') . ': 5)'" />
    @for ($i = 1; $i <= $tournament->teamCapacity(); $i++)
        <div class="row">
            <div class="col-12 col-xs-6">
                <x-inputs.text :label="$i. '. ' . __('messages.Tag') . ' #'" name="player_tag[]" :required="$i <= 5 ? 'required' : null" />
            </div>
            <div class="col-12 col-xs-6">
                <x-inputs.text :label="__('messages.Name')" name="player_name[]" :required="$i <= 5 ? 'required' : null"/>
            </div>
        </div>
    @endfor

    <x-buttons.submit_button :name="__('messages.Register')" />

</form>
