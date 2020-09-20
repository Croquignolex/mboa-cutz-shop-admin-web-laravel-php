<div class="form-group">
    <label for="{{ $id }}">
        {{ $name }}
        @if ($errors->has($id))
            <span class="text-danger">
                {{ $errors->first($id) }}
            </span>
        @endif
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="{{ $icon }}"></i>
            </span>
        </div>
        <input id="{{ $id }}" name="{{ $id }}"
               type="{{ $type }}" value="{{ $value }}"
               class="form-control" {{ $attribute ?? '' }}
        >
    </div>
</div>