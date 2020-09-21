@if(session()->has('toast.message'))
    <script>
        callToaster(
            "{{ session('toast.title') }}",
            "{{ session('toast.message') }}"
        );
    </script>
@endif