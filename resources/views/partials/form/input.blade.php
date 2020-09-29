<div class="form-group">
    @include('partials.input-label', compact('id', 'name'))

    <input id="{{ $id }}"
           name="{{ $id }}"
           type="{{ $type }}"
           value="{{ $value }}"
           class="form-control border border-secondary"
    />
</div>