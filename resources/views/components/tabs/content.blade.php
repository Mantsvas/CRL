<div class="tab-pane fade show {{ $active == $key ? 'active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
    {{ $slot }}
</div>
