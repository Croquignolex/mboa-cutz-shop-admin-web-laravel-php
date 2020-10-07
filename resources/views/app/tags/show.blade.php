@extends('layouts.app')

@section('app.master.title', page_title('Détails étiquette'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails étiquette',
        'icon' => 'mdi mdi-tag-multiple',
        'chain' => ['Etiquettes', 'Détails étiquette']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-5 col-xl-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-warning" href="{{ route('tags.edit', compact('tag')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        @if($tag->can_delete)
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#archive-tag-modal" }}"
                            >
                                <i class="mdi mdi-archive"></i>
                                Archiver
                            </button>
                        @endif
                    </div>
                    <div class="contact-info">
                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (français)</p>
                        <p>{{ $tag->fr_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (anglais)</p>
                        <p>{{ $tag->en_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description</p>
                        <p>{{ $tag->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{--Logs--}}
        <div class="col-lg-7 col-xl-8">
            <div class="card card-default">
                <div class="card-body">
                    <div id="accordion" class="accordion accordion-bordered ">
                        <div class="card">
                            <div class="card-header" id="heading-image">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-products" aria-expanded="true" aria-controls="collapse-products">
                                    Produits ({{ $products->total() }})
                                </button>
                            </div>
                            <div id="collapse-products" class="collapse show" aria-labelledby="heading-products" data-parent="#accordion">
                                <div class="card-body">
                                    {{--Products--}}
                                    <div class="mb-3">
                                        <button class="btn btn-primary"
                                                data-toggle="modal"
                                                data-target="#add-product-modal"
                                        >
                                            <i class="mdi mdi-plus"></i>
                                            Ajouter un produit
                                        </button>
                                    </div>
                                    @include('partials.products-list', ['actions' => false])
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading-services">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-services" aria-expanded="false" aria-controls="collapse-services">
                                    Services ({{ $services->total() }})
                                </button>
                            </div>
                            <div id="collapse-services" class="collapse" aria-labelledby="heading-services" data-parent="#accordion">
                                <div class="card-body">
                                    {{--Services--}}
                                    <button class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target="#add-service-modal"
                                    >
                                        <i class="mdi mdi-plus"></i>
                                        Ajouter un service
                                    </button>
                                    @include('partials.services-list', ['actions' => false])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($tag->can_delete)
        @include('partials.archive.archive-confirmation', [
            'name' => $tag->fr_name,
            'modal_id' => "archive-tag-modal",
            'url' => route('tags.destroy', compact('tag'))
        ])
    @endif
    @component('components.add-product-modal', [
        'url' => route('tags.add.product', compact('tag'))
    ])
        @include('partials.form.select', [
            'name' => 'Catégorie*',
            'id' => 'category',
            'title' => 'Choisir une catégorie',
            'value' => old('category'),
            'options' => $categories,
            'multi' => false
        ])
    @endcomponent
    @component('components.add-service-modal', [
        'url' => route('tags.add.service', compact('tag'))
    ])
        @include('partials.form.select', [
            'name' => 'Catégorie*',
            'id' => 'category',
            'title' => 'Choisir une catégorie',
            'value' => old('category'),
            'options' => $categories,
            'multi' => false
        ])
    @endcomponent
@endsection

@include('partials.select-scripts')