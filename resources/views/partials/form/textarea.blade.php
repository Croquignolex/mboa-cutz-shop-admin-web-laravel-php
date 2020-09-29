<div class="form-group">
    @include('partials.input-label', compact('id', 'name'))

    <textarea rows="5"
              id="{{ $id }}"
              name="{{ $id }}"
              class="form-control border border-secondary"
    >{{ $value }}</textarea>
</div>