@push('app.master.style')
    <link rel="stylesheet" href="{{ css_asset('bootstrap-select.min') }}" type="text/css">
@endpush

@push('app.master.script')
    <script src="{{ js_asset('bootstrap-select.min') }}" type="application/javascript"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('select').selectpicker();
        });
    </script>
@endpush
