@extends('layouts.app')

@section('app.master.title', page_title('Détails service'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails service',
        'icon' => 'mdi mdi-shopping',
        'chain' => ['Services', 'Détails service']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-5 col-xl-4">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-2">
                        <a class="btn btn-warning" href="{{ route('services.edit', compact('service')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        <button class="btn btn-danger"
                                data-toggle="modal"
                                data-target="{{ "#archive-service-modal" }}"
                        >
                            <i class="mdi mdi-archive"></i>
                            Archiver
                        </button>
                    </div>
                    <div class="contact-info">
                        <p class="text-right">
                            @if($service->is_a_new)
                                <span class="badge badge-pill badge-success mt-1">Nouveau</span>
                            @endif
                            @if($service->is_featured)
                                <span class="badge badge-pill badge-info mt-1">En vedette</span>
                            @endif
                            @if($service->is_a_discount)
                                <span class="badge badge-pill badge-secondary mt-1">En promo</span>
                            @endif
                            @if($service->is_most_asked)
                                <span class="badge badge-pill badge-primary mt-1">Meilleur reservation</span>
                            @endif
                        </p>
                        <p class="text-right text-theme" style="white-space: nowrap;">
                            @include('partials.rating-star', ['rate' => $service->rate])
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (francais)</p>
                        <p>{{ $service->fr_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (anglais)</p>
                        <p>{{ $service->en_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Prix</p>
                        <p>{{ format_price($service->price) }} FCFA</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Reduction</p>
                        <p>{{ $service->discount }} %</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Catégorie</p>
                        <p>
                            <a href="{{ route('categories.show', ['category' => $service->category]) }}"
                               class="btn btn-sm btn-outline-primary"
                            >
                                    {{ $service->category->fr_name }}
                            </a>
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Etiquettes</p>
                        <p>
                            @foreach($service->tags as $tag)
                                <a href="{{ route('tags.show', compact('tag')) }}"
                                   class="btn btn-sm btn-outline-primary"
                                >
                                    {{ $tag->fr_name }}
                                </a>
                            @endforeach
                        </p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (francais)</p>
                        <p>{{ $service->fr_description }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (anglais)</p>
                        <p>{{ $service->en_description }}</p>
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
                                        'model' => $service,
                                        'round_image' => false,
                                        'croup_ratio' => 'rectangle',
                                        'url' => route('services.update.image', compact('service'))
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading-comments">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-comments" aria-expanded="false" aria-controls="collapse-comments">
                                    Commentaires ({{ $reviews->total() }})
                                </button>
                            </div>
                            <div id="collapse-comments" class="collapse" aria-labelledby="heading-comments" data-parent="#accordion">
                                <div class="card-body">
                                    {{--Comments--}}
                                    @include('partials.services.service-reviews-list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @include('partials.archive.archive-confirmation', [
        'name' => $service->name,
        'modal_id' => "archive-service-modal",
        'url' => route('services.destroy', compact('service'))
    ])
@endsection

@include('partials.croup.croup-scripts')