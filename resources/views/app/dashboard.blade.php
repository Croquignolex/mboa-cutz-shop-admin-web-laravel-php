@extends('layouts.app')

@section('app.master.title', page_title('Tableau de bord'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Tableau de bord',
        'icon' => 'mdi mdi-view-dashboard-outline',
        'chain' => ['Tableau de bord']
    ])
@endsection

@section('app.master.body')

@endsection
