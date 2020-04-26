<x-cards.responsive-card :cardTitle="__('messages.Basic info')">
    <div class="row">
        <div class="col-12 col-md-8 border-left border-info" style="border-width: 5px;">
            <p>{{ $tournament->description }}</p>
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