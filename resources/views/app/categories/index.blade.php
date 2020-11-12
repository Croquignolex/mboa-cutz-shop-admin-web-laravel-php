@extends('layouts.app')

@section('app.master.title', page_title('Categories'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Categories ({$categories->total()})",
        'icon' => 'mdi mdi-database',
        'chain' => ['Categories']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('categories.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouvelle catégorie
                        </a>
                    </div>

                    <div class="mb-3">{{ $categories->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                    <th scope="col">CREATION</th>
                                <th scope="col">NOM (fr)</th>
                                <th scope="col">NOM (EN)</th>
                                <th scope="col">PRODUITS</th>
                                <th scope="col">SERVICES</th>
                                <th scope="col">ARTICLES</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $category->creation_date }}</td>
                                        <td>{{ $category->fr_name }}</td>
                                        <td>{{ $category->en_name }}</td>
                                        <td class="text-right">{{ $category->products->count() }}</td>
                                        <td class="text-right">{{ $category->services->count() }}</td>
                                        <td class="text-right">{{ $category->articles->count() }}</td>
                                        <td>{{ $category->creator_name}}</td>
                                        <td class="text-center" style="white-space: nowrap;">
                                            <a href="{{ route('categories.show', compact('category')) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Détails"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('categories.edit', compact('category')) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Modifier"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @if($category->can_delete)
                                                <button class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$category->slug-archive-category-modal" }}"
                                                        title="Archiver"
                                                >
                                                    <i class="mdi mdi-archive"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($category->can_delete)
                                        @include('partials.archive.archive-confirmation', [
                                            'name' => $category->fr_name,
                                            'modal_id' => "$category->slug-archive-category-modal",
                                            'url' => route('categories.destroy', compact('category'))
                                        ])
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $categories->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection