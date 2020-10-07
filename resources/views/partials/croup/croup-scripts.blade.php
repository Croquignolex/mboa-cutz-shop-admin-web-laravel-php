@push('app.master.style')
    <link rel="stylesheet" href="{{ css_asset('cropper.min') }}" type="text/css">
@endpush

@push('app.master.script')
    <script src="{{ js_asset('cropper.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('image-crouping') }}" type="application/javascript"></script>
@endpush
