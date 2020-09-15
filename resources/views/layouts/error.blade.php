@extends('master')

@section('master.title')@yield('error.master.title')@endsection

@section('master.body')
    <div id="notfound">
        <div id="particles-js" class="home-particles"></div>
        <div class="notfound home-particles" id="particles-js">
            <div class="notfound-404">@yield('error.code')</div>
            <p class="jump"><strong>@yield('error.title')</strong></p>
            <p>@yield('error.message')</p>
            <a href="{{ route('dashboard.index') }}">Retour</a>
        </div>
        <div id="particles-js" class="home-particles"></div>
    </div>
@endsection

@push('master.style')
    <link rel="stylesheet" href="{{ css_asset('error') }}" type="text/css">
@endpush

@push('master.script')
    <script src="{{ js_asset('jquery-3.2.1.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('plugins') }}" type="text/javascript"></script>
    <script src="{{ js_asset('polygons') }}" type="text/javascript"></script>
@endpush