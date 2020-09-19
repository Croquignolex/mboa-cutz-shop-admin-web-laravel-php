@extends('layouts.app')

@section('app.master.title', page_title('Paramètres'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Paramètres',
        'icon' => 'mdi mdi-settings',
        'chain' => ['Paramètres']
    ])
@endsection

@section('app.master.body')

@endsection
