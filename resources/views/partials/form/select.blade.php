<div class="form-group">
    @include('partials.input-label', compact('id', 'name'))

    <select data-size="10"
            id="{{ $id }}"
            name="{{ $id }}"
            data-live-search="true"
            title="{{ $title }}..."
            {{ $attributte ?? '' }}
            class="searchable-select form-control"
            data-style="btn-white border border-secondary"
    >
        @foreach($options as $option)
            <option value="{{ $option['value'] }}"
                    data-content="<span class='{{ $option['class'] }}'>{{ $option['label'] }}<span>"
                    {{ $value === $option['value'] ? 'selected' : ''}}
            >
            </option>
        @endforeach
    </select>
</div>