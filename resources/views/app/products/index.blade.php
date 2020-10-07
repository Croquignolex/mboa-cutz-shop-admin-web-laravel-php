@extends('layouts.app')

@section('app.master.title', page_title('Produits'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Produits ({$products->total()})",
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('products.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouveau produit
                        </a>
                    </div>
                    @include('partials.products-list', ['actions' => true])
                </div>
            </div>
        </div>
    </div>
@endsection
