<x-cards.responsive-card :cardTitle="__('messages.Basic info')">
    <x-slot name="cardTools">
        @if ($tournament->stage == 'preparation')
            <x-buttons.redirect-button :route="route('tournaments.show', ['tournament' => $tournament, 'activeTab' => 'players'])" :name="__('messages.Sign up')" />
        @endif
    </x-slot>
    <div class="row">
        <div class="col-12 col-md-8 border-left border-info" style="border-width: 5px;">
            {!! $tournament->description !!}
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
@if (isset($tournament->video_link))
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
            <div class="video-responsive">
                <iframe width="560" height="315" src="{{ $tournament->video_link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endif