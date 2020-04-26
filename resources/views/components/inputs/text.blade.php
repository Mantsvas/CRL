<div class="input-group mb-3">
    <div class="input-group-prepend">
        @if (isset($label))
            <span class="input-group-text">{{ $label }}</span>
        @endif
    </div>
    <input class="form-control {{ $inputClasses ?? null }}" {{ $required }}
            name="{{ $name }}" 
            type="text"  
            placeholder="{{ $placeholder }}" 
            value="{{ $value }}"
            id="{{ $id }}"
            >
</div>