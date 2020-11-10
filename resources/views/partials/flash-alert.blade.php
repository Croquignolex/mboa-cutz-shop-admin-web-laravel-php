@if(session()->has('toast.alert'))
    <script>
        callToaster(
            "{{ session('toast.title') }}",
            "{{ session('toast.message') }}",
            "{{ session('toast.type') }}",
            "{{ session('toast.delay') }}"
        );
    </script>
@endif