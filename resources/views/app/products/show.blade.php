@extends('layouts.app')

@section('app.master.title', page_title('Détails produit'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails produit',
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits', 'Détails produit']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-5 col-xl-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-2">
                        <a class="btn btn-warning" href="{{ route('products.edit', compact('product')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        @if($product->can_delete)
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#archive-product-modal" }}"
                            >
                                <i class="mdi mdi-archive"></i>
                                Archiver
                            </button>
                        @endif
                    </div>
                    <div class="contact-info">
                        <p class="text-right">@include('partials.products.products-status')</p>
                        <p class="text-right text-theme" style="white-space: nowrap;">
                            @include('partials.rating-star', ['rate' => $product->rate])
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (francais)</p>
                        <p>{{ $product->fr_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (anglais)</p>
                        <p>{{ $product->en_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Stock</p>
                        <p>{{ $product->stock }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Prix</p>
                        <p>{{ format_price($product->price) }} FCFA</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Reduction</p>
                        <p>{{ $product->discount }} %</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Catégorie</p>
                        <p>
                            <a href="{{ route('categories.show', ['category' => $product->category]) }}"
                               class="btn btn-sm btn-outline-primary"
                            >
                                    {{ $product->category->fr_name }}
                            </a>
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Etiquettes</p>
                        <p>
                            @foreach($product->tags as $tag)
                                <a href="{{ route('tags.show', compact('tag')) }}"
                                   class="btn btn-sm btn-outline-primary"
                                >
                                    {{ $tag->fr_name }}
                                </a>
                            @endforeach
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (francais)</p>
                        <p>{{ $product->fr_description }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (anglais)</p>
                        <p>{{ $product->en_description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8">
            <div class="card card-default">
                <div class="card-body">
                    <div id="accordion" class="accordion accordion-bordered ">
                        <div class="card">
                            <div class="card-header" id="heading-image">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-image" aria-expanded="true" aria-controls="collapse-image">
                                    Image
                                </button>
                            </div>
                            <div id="collapse-image" class="collapse show" aria-labelledby="heading-image" data-parent="#accordion">
                                <div class="card-body">
                                    {{--Image edit--}}
                                    @include('partials.model-image-edit', [
                                        'model' => $product,
                                        'round_image' => false,
                                        'croup_ratio' => 'square',
                                        'url' => route('products.update.image', compact('product'))
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading-comments">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-comments" aria-expanded="false" aria-controls="collapse-comments">
                                    Commentaires ({{ $reviews->total() }})
                                </button>
                            </div>
                            <div id="collapse-comments" class="collapse" aria-labelledby="heading-comments" data-parent="#accordion">
                                <div class="card-body">
                                    {{--Comments--}}
                                    @include('partials.products.product-reviews-list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($product->can_delete)
        @include('partials.archive.archive-confirmation', [
            'name' => $product->fr_name,
            'modal_id' => "archive-product-modal",
            'url' => route('products.destroy', compact('product'))
        ])
    @endif
@endsection

@include('partials.croup.croup-scripts')