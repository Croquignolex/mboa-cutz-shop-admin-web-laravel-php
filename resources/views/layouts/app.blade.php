@extends('master')

@section('master.title')@yield('app.master.title')@endsection

@section('master.class', 'sidebar-fixed sidebar-dark header-light header-fixed')

@section('master.body')
    <div class="wrapper">
        @include('partials.menu')
        @include('partials.navbar')
        @yield('app.master.body')
    </div>
@endsection

@push('master.style')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ css_asset('toastr.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('sleek') }}" type="text/css">
    @stack('app.master.style')
@endpush


@push('master.script')
    <script src="{{ js_asset('plugins/jquery/jquery.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('plugins/bootstrap/js/bootstrap.bundle.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('plugins/toaster/toastr.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('plugins/slimscrollbar/jquery.slimscroll.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('sleek') }}" type="application/javascript"></script>
    @stack('app.master.script')
@endpush
