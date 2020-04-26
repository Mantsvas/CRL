<div class="input-group mb-3">
    <div class="input-group-prepend">
        @if (isset($label))
            <span class="input-group-text">{{ $label }}</span>
        @endif
    </div>
    <input id="{{ $id }}" class="form-control datepicker {{ $inputClasses ?? null }}"
            name="{{ $name }}" 
            type="date"  
            placeholder="{{ $placeholder }}" 
            value={{ $value }}
            >
</div>