@extends('layouts.app')

@section('app.master.title', page_title('Détails article'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails article',
        'icon' => 'mdi mdi-blinds',
        'chain' => ['Articles', 'Détails article']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-5 col-xl-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-2">
                        <a class="btn btn-warning" href="{{ route('articles.edit', compact('article')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        @if($article->can_delete)
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#archive-article-modal" }}"
                            >
                                <i class="mdi mdi-archive"></i>
                                Archiver
                            </button>
                        @endif
                    </div>
                    <div class="contact-info">
                        <p class="text-right">@include('partials.articles.articles-status')</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (francais)</p>
                        <p>{{ $article->fr_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (anglais)</p>
                        <p>{{ $article->en_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Catégorie</p>
                        <p>
                            <a href="{{ route('categories.show', ['category' => $article->category]) }}"
                               class="btn btn-sm btn-outline-primary"
                            >
                                    {{ $article->category->fr_name }}
                            </a>
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Etiquettes</p>
                        <p>
                            @foreach($article->tags as $tag)
                                <a href="{{ route('tags.show', compact('tag')) }}"
                                   class="btn btn-sm btn-outline-primary"
                                >
                                    {{ $tag->fr_name }}
                                </a>
                            @endforeach
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (francais)</p>
                        <p>{{ $article->fr_description }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (anglais)</p>
                        <p>{{ $article->en_description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8">
            <div class="card card-default">
                <div class="card-body">
                    <div id="accordion" class="accordion accordion-bordered ">
                        <div class="card">
                            <div class="card-header" id="heading-image">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-image" aria-expanded="true" aria-controls="collapse-image">
                                    Image
                                </button>
                            </div>
                            <div id="collapse-image" class="collapse show" aria-labelledby="heading-image" data-parent="#accordion">
                                <div class="card-body">
                                    {{--Image edit--}}
                                    @include('partials.model-image-edit', [
                                        'model' => $article,
                                        'round_image' => false,
                                        'croup_ratio' => 'rectangle',
                                        'url' => route('articles.update.image', compact('article'))
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading-comments">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-comments" aria-expanded="false" aria-controls="collapse-comments">
                                    Commentaires ({{ $comments->total() }})
                                </button>
                            </div>
                            <div id="collapse-comments" class="collapse" aria-labelledby="heading-comments" data-parent="#accordion">
                                <div class="card-body">
                                    {{--Comments--}}
                                    @include('partials.articles.article-comments-list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($article->can_delete)
        @include('partials.archive.archive-confirmation', [
            'name' => $article->fr_name,
            'modal_id' => "archive-article-modal",
            'url' => route('articles.destroy', compact('article'))
        ])
    @endif
@endsection

@include('partials.croup.croup-scripts')