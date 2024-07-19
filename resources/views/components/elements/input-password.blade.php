<div id="form-input">
    <div class="input-group" id="input-{{ $id ?? '' }}">             
        <div class="form-floating">
            <input
            type="password"
            class="form-control"
            id="{{ $id ?? '' }}"
            name="{{ $name ?? '' }}"
            placeholder="{{ $placeholder }}"
            value="{{ $value ?? '' }}"
            required
            {{ $attributes }}>
            <label id="label-input" for="{{ $id ?? '' }}">{{ $placeholder ?? '' }}</label>
        </div>
        <span class="input-group-text togglePassword{{ $toggle ?? '' }}">
            <i class="bi bi-eye-fill"></i>
        </span>
    </div>
    <div id="{{ $id ?? '' }}-error" class="invalid-feedback">
    </div>
</div>