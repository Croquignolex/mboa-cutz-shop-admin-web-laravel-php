@extends('layouts.app')

@section('app.master.title', page_title('Etiquettes archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Etiquettes archivés ({$tags->total()})",
        'icon' => 'mdi mdi-tag-multiple',
        'chain' => ['Archives', 'Etiquettes archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $tags->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">NOM (fr)</th>
                                <th scope="col">NOM (EN)</th>
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
                                    <td>{{ $tag->creator_name}}</td>
                                    <td class="text-center">
                                        @if($tag->can_delete)
                                            <button class="btn btn-sm btn-success"
                                                    data-toggle="modal"
                                                    data-target="{{ "#$tag->slug-restore-tag-modal" }}"
                                                    title="Restorer"
                                            >
                                                <i class="mdi mdi-backup-restore"></i>
                                                Restorer
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                @if($tag->can_delete)
                                    @include('partials.restore-confirmation', [
                                        'name' => $tag->fr_name,
                                        'modal_id' => "$tag->slug-restore-tag-modal",
                                        'url' => route('archives.tags.restore', compact('tag'))
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