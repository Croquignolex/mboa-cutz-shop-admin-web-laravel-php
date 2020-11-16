@extends('layouts.app')

@section('app.master.title', page_title('Gallery'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Gallery ({$pictures->total()})",
        'icon' => 'mdi mdi-image-multiple',
        'chain' => ['Gallery']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('pictures.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouvel image
                        </a>
                    </div>

                    <div class="mb-3">{{ $pictures->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                    <th scope="col">CREATION</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">DESCRIPTION (FR)</th>
                                <th scope="col">DESCRIPTION (EN)</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pictures as $picture)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $picture->creation_date }}</td>
                                        <td class="text-center">
                                            <img class="w-45" src="{{ $picture->image_src }}" alt="..." />
                                        </td>
                                        <td>{{ $picture->fr_description }}</td>
                                        <td>{{ $picture->en_description }}</td>
                                        <td>{{ $picture->creator_name}}</td>
                                        <td class="text-center" style="white-space: nowrap;">
                                            <a href="{{ route('pictures.show', compact('picture')) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Détails"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('pictures.edit', compact('picture')) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Modifier"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @if($picture->can_delete)
                                                <button class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$picture->id-archive-picture-modal" }}"
                                                        title="Archiver"
                                                >
                                                    <i class="mdi mdi-archive"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($picture->can_delete)
                                        @include('partials.archive.archive-confirmation', [
                                            'name' => $picture->fr_description,
                                            'modal_id' => "$picture->id-archive-picture-modal",
                                            'url' => route('pictures.destroy', compact('picture'))
                                        ])
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $pictures->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection