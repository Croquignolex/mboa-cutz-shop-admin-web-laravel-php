<div class="form-group">
    <label for="{{ $id }}">
        {{ $name }}
        @if ($errors->has($id))
            <span class="text-danger">
                {{ $errors->first($id) }}
            </span>
        @endif
    </label>
    <textarea rows="5"
              id="{{ $id }}"
              name="{{ $id }}"
              class="form-control border border-secondary"
    >{{ $value }}</textarea>
</div>