@extends('master')

@section('master.title')@yield('app.master.title')@endsection

@section('master.body')
    @yield('app.master.body')
@endsection

@push('master.style')
    @stack('app.master.style')
@endpush

@push('master.script')
    @stack('app.master.script')
@endpush
