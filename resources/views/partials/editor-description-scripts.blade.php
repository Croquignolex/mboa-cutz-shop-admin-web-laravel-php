@push('app.master.style')
    @if(config('app.env') === 'production')
        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    @else
        <link rel="stylesheet" href="{{ css_asset('quill.snow') }}" type="text/css">
    @endif
@endpush

@push('app.master.script')
    @if(config('app.env') === 'production')
        <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    @else
        <script src="{{ js_asset('quill.min') }}" type="application/javascript"></script>
    @endif
    <script type="application/javascript">
        const options = {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['link', 'image'],
                    ['blockquote', 'code-block'],
                    [{'header': 1}, {'header': 2}],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                ]
            },
            theme: 'snow'
        };

        let frDescriptionEditor = new Quill('#fr_description_editor', options)
        let enDescriptionEditor = new Quill('#en_description_editor', options)

        frDescriptionEditor.on('text-change', function () {
            document.getElementById("fr_description").value = frDescriptionEditor.root.innerHTML;
        })

        frDescriptionEditor.on('text-change', function () {
            document.getElementById("en_description").value = enDescriptionEditor.root.innerHTML;
        })
    </script>
@endpush
