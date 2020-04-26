<div class="form-group">

    @if (isset($label))
        <label>{{ $label }}</label>
    @endif

    <textarea class="form-control {{ $inputClasses ?? null}}" 
            name="{{ $name }}" 
            id="{{ $id}}" 
            cols="{{ $cols }}" 
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
        >{{ $value }}</textarea>

</div>