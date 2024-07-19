<div id="form-input">
    <div id="input-{{ $id ?? '' }}" class="form-floating">
        <input
        type="{{ $type ?? 'text' }}"
        class="form-control"
        id="{{ $id ?? '' }}"
        name="{{ $name ?? '' }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        required
        {{ $attributes }}>
        <label id="label-input" for="{{ $id ?? '' }}">{{ $placeholder }}</label>
    </div>
    <div id="{{ $id ?? '' }}-error" class="invalid-feedback">
    </div>
</div>