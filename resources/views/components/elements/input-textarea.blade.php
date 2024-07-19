<div id="form-input">
    <div id="input-{{ $name ?? '' }}"class="form-floating">
        <textarea
        class="form-control"
        id="{{ $id ?? '' }}"
        name="{{ $name ?? '' }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        required
        {{ $attributes }}>
        </textarea>
        <label id="label-input" for="{{ $id ?? '' }}">{{ $placeholder }}</label>
    </div>
    <div id="{{ $name ?? '' }}-error" class="invalid-feedback">
    </div>
</div>