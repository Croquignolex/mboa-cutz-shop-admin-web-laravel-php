@extends('layouts.app')

@section('app.master.title', page_title('Etiquettes'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Etiquettes ({$tags->total()})",
        'icon' => 'mdi mdi-mdi-tag-multiple',
        'chain' => ['Etiquettes']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('tags.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouvelle étiquette
                        </a>
                    </div>

                    <div class="mb-3">{{ $tags->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">NOM (fr)</th>
                                <th scope="col">NOM (en)</th>
                                <th scope="col">PRODUITS</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->creation_date }}</td>
                                        <td>{{ $tag->fr_name }}</td>
                                        <td>{{ $tag->en_name }}</td>
                                        <td class="text-right">{{ $tag->products->count() }}</td>
                                        <td>{{ $tag->creator_name}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('tags.show', compact('tag')) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Détails"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('tags.edit', compact('tag')) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Modifier"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @if($tag->can_delete)
                                                <button class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$tag->slug-archive-tag-modal" }}"
                                                        title="Archiver"
                                                >
                                                    <i class="mdi mdi-archive"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($tag->can_delete)
                                        @include('partials.archive-confirmation', [
                                            'name' => $tag->fr_name,
                                            'modal_id' => "$tag->slug-archive-tag-modal",
                                            'url' => route('tags.destroy', compact('tag'))
                                        ])
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $tags->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection