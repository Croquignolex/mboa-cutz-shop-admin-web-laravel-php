<div class="form-group">
    <label for="{{ $id }}">
        {{ $name }}
        @if ($errors->has($id))
            <span class="text-danger">
                {{ $errors->first($id) }}
            </span>
        @endif
    </label>
    <input id="{{ $id }}"
           name="{{ $id }}"
           type="{{ $type }}"
           value="{{ $value }}"
           class="form-control border border-secondary"
    />
</div>