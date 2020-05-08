<x-cards.responsive-card :cardTitle="__('messages.Rules')">
    <x-slot name="cardTools">
        @if ($tournament->stage == 'preparation')
            <x-buttons.redirect-button :route="route('tournaments.show', ['tournament' => $tournament, 'activeTab' => 'players'])" :name="__('messages.Sign up')" />
        @endif
    </x-slot>
    <div class="row">
        <div class="col-12 col-md-8 border-left border-info" style="border-width: 5px;">
            {!! \App::getLocale() == 'lt' ? $tournament->rules : $tournament->rules_en !!}
        </div>
        <div class="col-12 col-md-4 border-left border-info" style="border-width: 5px;">
            <div class="row">
                <div class="col-6">
                    <span><strong>{{ __('messages.Type') }}:</strong></span>
                </div>
                <div class="col-6">
                    <span>{{ __('database.tournaments.types.' . $tournament->type) }}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <span><strong>{{ __('messages.Format') }}:</strong></span>
                </div>
                <div class="col-6">
                    <span>{{ __('database.tournaments.formats.' . $tournament->format) }}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <span><strong>{{ __('messages.Min participiants') }}:</strong></span>
                </div>
                <div class="col-6">
                    <span>{{ $tournament->min_participiants }}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <span><strong>{{ __('messages.Max participiants') }}:</strong></span>
                </div>
                <div class="col-6">
                    <span>{{ $tournament->max_participiants }}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <span><strong>{{ __('messages.Group count') }}:</strong></span>
                </div>
                <div class="col-6">
                    <span>{{ $tournament->group_count }}</span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <span><strong>{{ __('messages.Start date') }}:</strong></span>
                </div>
                <div class="col-6">
                    <span>{{ $tournament->start_date }}</span>
                </div>
            </div>
            
        </div>
    </div>

</x-cards.responsive-card>
