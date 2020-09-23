@extends('layouts.app')

@section('app.master.title', page_title('Tous les produits'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Tous les produits',
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits', 'Tous les produits']
    ])
@endsection

@section('app.master.body')

@endsection
