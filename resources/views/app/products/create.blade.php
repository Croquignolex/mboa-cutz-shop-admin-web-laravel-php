@extends('layouts.app')

@section('app.master.title', page_title('Nouveau produit'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Nouveau produit',
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits', 'Nouveau produit']
    ])
@endsection

@section('app.master.body')

@endsection
