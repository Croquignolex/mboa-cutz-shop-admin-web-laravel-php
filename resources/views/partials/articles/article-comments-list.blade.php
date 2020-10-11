<div class="mb-3">{{ $comments->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">DATE</th>
                <th scope="col">COMMENTAIRE</th>
                <th scope="col">CREER PAR</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->creation_date }}</td>
                    <td>{{ $comment->description }}</td>
                    <td>{{ $comment->creator_name}}</td>
                    <td class="text-center">
                        @if($comment->can_delete)
                            <button class="btn btn-sm btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#$comment->id-archive-comment-modal" }}"
                                    title="Archiver"
                            >
                                <i class="mdi mdi-archive"></i>
                            </button>
                        @endif
                    </td>
                </tr>
                @if($comment->can_delete)
                    @include('partials.archive.archive-confirmation', [
                        'name' => $comment->creation_date,
                        'modal_id' => "$comment->id-archive-comment-modal",
                        'url' => route('articles.remove.comment', compact('article', 'comment'))
                    ])
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<div>{{ $comments->links() }}</div>