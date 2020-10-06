<div class="form-group">
    @include('partials.input-label', compact('id', 'name'))

    <select data-size="10"
            id="{{ $id }}"
            class="form-control"
            data-live-search="true"
            title="{{ $title }}..."
            {{ $multi ? 'multiple' : '' }}
            name="{{ $multi ? "{$id}[]" : $id }}"
            data-style="btn-white border {{ $errors->has($id) ? 'border-danger' : 'border-secondary' }}"
    >
        @foreach($options as $option)
            @if($multi)
                <option value="{{ $option['value'] }}"
                        data-content="<span class='{{ $option['class'] }}'>{{ $option['label'] }}<span>"
                        @foreach($value as $item)
                            {{ $item->slug === $option['value'] ? 'selected' : ''}}
                        @endforeach
                >
                </option>
            @else
                <option value="{{ $option['value'] }}"
                        data-content="<span class='{{ $option['class'] }}'>{{ $option['label'] }}<span>"
                        {{ $value === $option['value'] ? 'selected' : ''}}
                >
                </option>
            @endif
        @endforeach
    </select>
</div>