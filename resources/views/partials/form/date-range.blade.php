<div class="form-group">
    @include('partials.input-label', compact('id', 'name'))

    <input type="text"
           id="{{ $id }}"
           name="{{ $id }}"
           class="form-control border {{ $errors->has($id) ? 'border-danger' : 'border-secondary' }}"
    />
</div>