<div class="form-group">
    <label for="{{ $id }}">
        {{ $name }}
        @if ($errors->has($id))
            <span class="text-danger">
                {{ $errors->first($id) }}
            </span>
        @endif
    </label>
    <select class="searchable-select form-control"
            name="state"
            data-live-search="true"
            title="Choose one of the following..."
            data-style="btn-white border border-secondary"
            data-size="10"
            {{ $multi ?? '' }}
    >
        <option value="AL">Alabama</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="WY">Wyoming</option>
    </select>
</div>