@extends('layouts.app')

@section('app.master.title', page_title('Images archivées'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Images archivées ({$pictures->total()})",
        'icon' => 'mdi mdi-image-multiple',
        'chain' => ['Archives', 'Images archivées']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

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
                                        <td class="text-center">
                                            @if($picture->can_delete)
                                                <button class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$picture->id-restore-picture-modal" }}"
                                                        title="Restorer"
                                                >
                                                    <i class="mdi mdi-backup-restore"></i>
                                                    Restorer
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($picture->can_delete)
                                        @include('partials.restore-confirmation', [
                                            'name' => $picture->fr_description,
                                            'modal_id' => "$picture->id-restore-picture-modal",
                                            'url' => route('archives.pictures.restore', compact('picture'))
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