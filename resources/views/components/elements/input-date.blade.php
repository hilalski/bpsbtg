<div id="form-input">
    <div id="input-{{ $name ?? '' }}" class="form-floating">
        <input
        type="date"
        class="form-control"
        id="{{ $id ?? '' }}"
        name="{{ $name ?? '' }}"
        autocomplete="off"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        required
        {{ $attributes }}>
        <label id="label-input" for="{{ $id ?? '' }}">{{ $placeholder }}</label>
    </div>
    <div id="{{ $name ?? '' }}-error" class="invalid-feedback">
    </div>
</div>
