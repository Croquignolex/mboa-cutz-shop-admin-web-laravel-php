@extends('master')

@section('master.title')@yield('app.master.title')@endsection

@section('master.class', 'header-fixed sidebar-fixed sidebar-dark header-light')

@section('master.body')
    <div class="mobile-sticky-body-overlay"></div>
    <div class="wrapper">
        {{--Menu content--}}
        @include('partials.menu')
        {{--Page--}}
        <div class="page-wrapper">
            {{--Navbar--}}
            @include('partials.navbar')
            <div class="content-wrapper">
                <div class="content">
                    {{--Page content--}}
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