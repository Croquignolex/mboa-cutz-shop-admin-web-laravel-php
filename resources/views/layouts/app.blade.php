@extends('master')

@section('master.title')@yield('app.master.title')@endsection

@section('master.class', 'sidebar-fixed sidebar-dark header-light header-fixed')

@section('master.body')
    <div class="wrapper">
        @include('partials.menu')
        <div class="page-wrapper">
            @include('partials.navbar')
            <div class="content-wrapper">
                <div class="content">
                    @yield('app.breadcrumb')
                    @yield('app.master.body')
                </div>
            </div>
            {{--Footer--}}
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p class="text-center">
                        Copyright &copy;  {{ config('app.name') }} 2020 | Design by
                        <a href="https://croquignolex.mboacutz.com/"
                           class="text-danger"
                           target="_blank"
                        >
                            Croquignolex
                        </a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
@endsection

@push('master.style')
    @stack('app.master.style')
@endpush

@push('master.script')
    <script src="{{ js_asset('jquery.slimscroll.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('sleek') }}" type="application/javascript"></script>
    @stack('app.master.script')
@endpush