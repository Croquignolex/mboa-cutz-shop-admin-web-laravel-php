@extends('layouts.app')

@section('app.master.title', page_title("Commentaires d'article archivés"))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Commentaires d'article archivés ({$comments->total()})",
        'icon' => 'mdi mdi-comment',
        'chain' => ['Archives', "Commentaires d'article archivés"]
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $comments->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">CREATION</th>
                                    <th scope="col">COMMENTAIRE</th>
                                    <th scope="col">ARTICLE</th>
                                    <th scope="col">CREER PAR</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $comment->creation_date }}</td>
                                        <td>{{ $comment->description }}</td>
                                        <td>
                                            <a href="{{ route('articles.show', ['article' => $comment->article]) }}"
                                               class="btn btn-sm btn-outline-primary"
                                            >
                                                {{ $comment->article->fr_name}}
                                            </a>
                                        </td>
                                        <td>{{ $comment->creator_name}}</td>
                                        <td class="text-center">
                                            @if($comment->can_delete)
                                                <button class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$comment->id-restore-comment-modal" }}"
                                                        title="Restorer"
                                                >
                                                    <i class="mdi mdi-backup-restore"></i>
                                                    Restorer
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($comment->can_delete)
                                        @include('partials.restore-confirmation', [
                                            'name' => $comment->creation_date,
                                            'modal_id' => "$comment->id-restore-comment-modal",
                                            'url' => route('archives.article-comments.restore', compact('comment'))
                                        ])
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $comments->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection