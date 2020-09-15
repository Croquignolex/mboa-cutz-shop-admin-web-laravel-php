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

@push('master.script')
    <script src="{{ js_asset('plugins/jquery/jquery.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('plugins/bootstrap/js/bootstrap.bundle.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('plugins/toaster/toastr.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('plugins/slimscrollbar/jquery.slimscroll.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('sleek') }}" type="application/javascript"></script>
    @stack('app.master.script')
@endpush
