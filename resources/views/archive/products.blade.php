@extends('layouts.app')

@section('app.master.title', page_title('Produits archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Produits archivés ({$products->total()})",
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits', 'Produits archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $products->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">NOM (fr)</th>
                                    <th scope="col">NOM (en)</th>
                                    <th scope="col">PRIX (FCFA)</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col">CREER PAR</th>
                                    <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->creation_date }}</td>
                                        <td class="text-center">
                                            <img class="w-45" src="{{ $product->image_src }}" alt="..." />
                                        </td>
                                        <td>{{ $product->fr_name }}</td>
                                        <td>{{ $product->en_name }}</td>
                                        <td class="text-right">{{ format_price($product->price) }}</td>
                                        <td class="text-right">{{ $product->stock }}</td>
                                        <td>{{ $product->creator_name}}</td>
                                        <td class="text-center">
                                            @if($product->can_delete)
                                                <button class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$product->slug-restore-product-modal" }}"
                                                        title="Restorer"
                                                >
                                                    <i class="mdi mdi-backup-restore"></i>
                                                    Restorer
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @include('partials.restore-confirmation', [
                                        'name' => $product->fr_name,
                                        'modal_id' => "$product->slug-restore-product-modal",
                                        'url' => route('archives.products.restore', compact('product'))
                                    ])
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection