<div>
    <ul class="nav nav-tabs customTabs" role="tablist">
        @foreach($tabs as $key => $tab)
            <li class="nav-item">
                <a 
                    class="nav-link {{ $active == $key ? 'active' : '' }}" 
                    href="#{{ $key }}" 
                    id="{{ $key }}-tab" 
                    aria-controls="{{ $key }}" 
                    role="tab" 
                    data-toggle="tab" 
                    role="tab"
                >{{ $tab }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        {{ $slot }}
    </div>
</div>