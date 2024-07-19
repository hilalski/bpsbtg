<div id="form-input">
    <div id="input-{{ $name ?? '' }}" class="form-floating">
        <input
        type="file"
        class="form-control"
        id="{{ $id ?? '' }}"
        name="{{ $name ?? '' }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        autocomplete="off"
        required
        {{ $attributes }}>
        <label id="label-input" for="{{ $id ?? '' }}">{{ $placeholder }}</label>
    </div>
    <div id="{{ $name ?? '' }}-error" class="invalid-feedback">
    </div>
</div>
