<div class="input-group mb-3">
    <div class="input-group-prepend">
        @if (isset($label))
            <span class="input-group-text">{{ $label }}</span>
        @endif
    </div>
    <input id="{{ $id }}" class="form-control {{ $inputClasses ?? null }}" {{ $required }}
            name="{{ $name }}" 
            type="number"  
            placeholder="{{ $placeholder }}" 
            value={{ $value }}
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step }}"
            >
</div>