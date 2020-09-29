@extends('layouts.app')

@section('app.master.title', page_title('Détails catégorie'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails catégorie',
        'icon' => 'mdi mdi-mdi-tag-multiple',
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
                    <h5>Produits ({{ $products->total() }})</h5>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($category->can_delete)
        @include('partials.archive-confirmation', [
            'name' => $category->fr_name,
            'modal_id' => "archive-category-modal",
            'url' => route('categories.destroy', compact('category'))
        ])
    @endif
@endsection