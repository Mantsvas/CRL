<div class="input-group mb-3">
    <div class="input-group-prepend">
        @if (isset($label))
            <span class="input-group-text">{{ $label }}</span>
        @endif
    </div>
    <select id="{{ $id }}" class="form-control {{ $inputClasses ?? null }}" name="{{ $name }}" {{ $required }}>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : null }}>{{ $value }}</option>
        @endforeach
    </select>
</div>