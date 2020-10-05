@extends('layouts.app')

@section('app.master.title', page_title('Détails catégorie'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails catégorie',
        'icon' => 'mdi mdi-database',
        'chain' => ['Administrateurs', 'Détails catégorie']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-5 col-xl-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-warning" href="{{ route('categories.edit', compact('category')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        @if($category->can_delete)
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#archive-category-modal" }}"
                            >
                                <i class="mdi mdi-archive"></i>
                                Archiver
                            </button>
                        @endif
                    </div>
                    <div class="contact-info">
                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (français)</p>
                        <p>{{ $category->fr_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (anglais)</p>
                        <p>{{ $category->en_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description</p>
                        <p>{{ $category->description }}</p>
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
    @if($category->can_delete)
        @include('partials.archive.archive-confirmation', [
            'name' => $category->fr_name,
            'modal_id' => "archive-category-modal",
            'url' => route('categories.destroy', compact('category'))
        ])
    @endif
@endsection