<div class="mb-3">{{ $articles->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">DATE</th>
                <th scope="col">IMAGE</th>
                <th scope="col">NOM (fr)</th>
                <th scope="col">NOM (en)</th>
                @if($actions)<th scope="col">COMMENTAIRES</th>@endif
                <th scope="col">CREER PAR</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->creation_date }}</td>
                    <td class="text-center">
                        <img class="w-45" src="{{ $article->image_src }}" alt="..." />
                    </td>
                    <td>{{ $article->fr_name }}</td>
                    <td>{{ $article->en_name }}</td>
                    @if($actions)<td class="text-right">{{ $article->comments->count() }}</td>@endif
                    <td>{{ $article->creator_name}}</td>
                    <td class="text-center" style="white-space: nowrap;">
                        <a href="{{ route('articles.show', compact('article')) }}"
                           class="btn btn-sm btn-primary"
                           title="Détails"
                        >
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="{{ route('articles.edit', compact('article')) }}"
                           class="btn btn-sm btn-warning"
                           title="Modifier"
                        >
                            <i class="mdi mdi-pencil"></i>
                        </a>
                        @if($article->can_delete && $actions)
                            <button class="btn btn-sm btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#$article->slug-archive-article-modal" }}"
                                    title="Archiver"
                            >
                                <i class="mdi mdi-archive"></i>
                            </button>
                        @endif
                    </td>
                </tr>

                @if($article->can_delete && $actions)
                    @include('partials.archive.archive-confirmation', [
                        'name' => $article->fr_name,
                        'modal_id' => "$article->slug-archive-article-modal",
                        'url' => route('articles.destroy', compact('article'))
                    ])
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<div>{{ $articles->links() }}</div>