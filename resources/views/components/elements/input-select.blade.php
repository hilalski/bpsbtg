<div id="form-input">
    <div id="input-{{ $name ?? '' }}" class="form-floating">
        <select
        class="form-select"
        id="{{ $id ?? '' }}"
        name="{{ $name ?? '' }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        autocomplete="off"
        required
        {{ $attributes }}>
            <option value="" disabled selected>Pilih {{ $placeholder }}</option>
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
            @endforeach
        </select>
        <label id="label-input" for="{{ $id ?? '' }}">{{ $placeholder }}</label>
    </div>
    <div id="{{ $name ?? '' }}-error" class="invalid-feedback">
    </div>
</div>