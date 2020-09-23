@extends('layouts.app')

@section('app.master.title', page_title('Tous les categories'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Tous les categories',
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits', 'Tous les categories']
    ])
@endsection

@section('app.master.body')

@endsection
