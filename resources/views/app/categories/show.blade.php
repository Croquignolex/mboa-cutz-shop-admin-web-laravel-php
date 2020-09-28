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
    <div class="bg-white border rounded">
        <div class="row no-gutters">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Details {{ $category->fr_name }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-right">
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

                        <div class="row no-gutters">
                            <div class="col-lg-5 col-xl-4">
                                <div class="profile-content-left p-4">
                                    @include('partials.user-info', [
                                        'user' => $admin,
                                        'can_update_avatar' => false
                                    ])
                                </div>
                            </div>
                            <div class="col-lg-7 col-xl-8">
                                <div class="profile-content-right p-4">
{{--                                    <h5>Produits ({{ $products->total() }})</h5>--}}
                                    <h5>Produits (0)</h5>
                                    @include('partials.user-logs', compact('logs'))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($category->can_delete)
        @include('partials.archive-confirmation', [
            'name' => $category->fr_name,
            'modal_id' => "archive-category-modal",
            'url' => route('categories.destroy', compact('category'))
        ])
    @endif
@endsection