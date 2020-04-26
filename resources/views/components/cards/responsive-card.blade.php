<div class="row">
    <div class="col-12">
        <div class="card card-{{ $cardType }}">
            @if(isset($cardTitle))
                <div class="card-header">
                    <h3 class="card-title">{{ $cardTitle }}</h3>
                    @if (isset($cardTools))
                        <div class="card-tools">
                            {{ $cardTools }}
                        </div>
                    @endif
                </div>
            @endif
            <div class="card-body table-responsive {{ $contentClasses ?? null }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>