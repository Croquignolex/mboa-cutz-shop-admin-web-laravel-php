<div class="form-group">
    @include('partials.input-label', compact('id', 'name'))

    <div id="{{ $id }}_editor" style="min-height: 150px;">{!! $value !!}</div>

    <input type="hidden" id="{{ $id }}" name="{{ $id }}" value="{{ $value }}"/>
</div>