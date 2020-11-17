@extends('layouts.app')

@section('app.master.title', page_title('Categories archivées'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Categories archivées ({$categories->total()})",
        'icon' => 'mdi mdi-database',
        'chain' => ['Archives', 'Categories archivées']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $categories->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                    <th scope="col">CREATION</th>
                                <th scope="col">NOM (fr)</th>
                                <th scope="col">NOM (EN)</th>
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
                                    <td>{{ $category->creator_name}}</td>
                                    <td class="text-center">
                                        @if($category->can_delete)
                                            <button class="btn btn-sm btn-success"
                                                    data-toggle="modal"
                                                    data-target="{{ "#$category->slug-restore-category-modal" }}"
                                                    title="Restorer"
                                            >
                                                <i class="mdi mdi-backup-restore"></i>
                                                Restorer
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                @if($category->can_delete)
                                    @include('partials.restore-confirmation', [
                                        'name' => $category->fr_name,
                                        'modal_id' => "$category->slug-restore-category-modal",
                                        'url' => route('archives.categories.restore', compact('category'))
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