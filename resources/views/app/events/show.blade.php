@extends('layouts.app')

@section('app.master.title', page_title('Détails évènement'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails évènement',
        'icon' => 'mdi mdi-string-lights',
        'chain' => ['Evènement', 'Détails évènement']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-6 col-xl-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-warning" href="{{ route('events.edit', compact('event')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        @if($event->can_delete)
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#archive-event-modal" }}"
                            >
                                <i class="mdi mdi-archive"></i>
                                Archiver
                            </button>
                        @endif
                    </div>
                    <div class="contact-info">
                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (francais)</p>
                        <p>{{ $event->fr_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom (anglais)</p>
                        <p>{{ $event->en_name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Lieux (francais)</p>
                        <p>{{ $event->fr_localisation }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Lieux (anglais)</p>
                        <p>{{ $event->en_localisation }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Date de début</p>
                        <p>{{ $event->start_date }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Date de fin</p>
                        <p>{{ $event->end_date }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (francais)</p>
                        <p>{{ $event->fr_description }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (anglais)</p>
                        <p>{{ $event->en_description }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{--Logs--}}
        <div class="col-lg-6 col-xl-6">
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
                                    {{--Image--}}
                                    @include('partials.model-image-edit', [
                                        'round_image' => false,
                                        'model' => $event,
                                        'croup_ratio' => 'square',
                                        'url' => route('events.update.image', compact('event'))
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading-map">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-map" aria-expanded="false" aria-controls="collapse-map">
                                    Carte
                                </button>
                            </div>
                            <div id="collapse-map" class="collapse" aria-labelledby="heading-map" data-parent="#accordion">
                                <div class="card-body text-center">
                                    {{--Map--}}
                                    <iframe src="{{ $event->map }}" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($event->can_delete)
        @include('partials.archive.archive-confirmation', [
            'name' => $event->fr_name,
            'modal_id' => "archive-event-modal",
            'url' => route('events.destroy', compact('event'))
        ])
    @endif
@endsection

@include('partials.croup.croup-scripts')