@extends('layouts.app')

@section('app.master.title', page_title('Articles archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Articles archivés ({$articles->total()})",
        'icon' => 'mdi mdi-blinds',
        'chain' => ['Articles', 'Articles archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $articles->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">CREATION</th>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">NOM (fr)</th>
                                    <th scope="col">NOM (EN)</th>
                                    <th scope="col">CREER PAR</th>
                                    <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $article->creation_date }}</td>
                                        <td class="text-center">
                                            <img class="w-45" src="{{ $article->image_src }}" alt="..." />
                                        </td>
                                        <td>{{ $article->fr_name }}</td>
                                        <td>{{ $article->en_name }}</td>
                                        <td>{{ $article->creator_name}}</td>
                                        <td class="text-center">
                                            @if($article->can_delete)
                                                <button class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$article->slug-restore-article-modal" }}"
                                                        title="Restorer"
                                                >
                                                    <i class="mdi mdi-backup-restore"></i>
                                                    Restorer
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @include('partials.restore-confirmation', [
                                        'name' => $article->fr_name,
                                        'modal_id' => "$article->slug-restore-article-modal",
                                        'url' => route('archives.articles.restore', compact('article'))
                                    ])
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $articles->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection