@extends('layouts.app')

@section('app.master.title', page_title('Détails image'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails image',
        'icon' => 'mdi mdi-image-multiple',
        'chain' => ['Gallery', 'Détails image']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-6 col-xl-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-warning" href="{{ route('pictures.edit', compact('picture')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        @if($picture->can_delete)
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#archive-picture-modal" }}"
                            >
                                <i class="mdi mdi-archive"></i>
                                Archiver
                            </button>
                        @endif
                    </div>
                    <div class="contact-info">
                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (francais)</p>
                        <p>{{ $picture->fr_description }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (anglais)</p>
                        <p>{{ $picture->en_description }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{--Logs--}}
        <div class="col-lg-6 col-xl-6">
            <div class="card card-default">
                <div class="card-body">
                    @include('partials.model-image-edit', [
                        'round_image' => false,
                        'model' => $picture,
                        'croup_ratio' => 'unknown',
                        'url' => route('pictures.update.image', compact('picture'))
                    ])
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @if($picture->can_delete)
        @include('partials.archive.archive-confirmation', [
            'name' => $picture->fr_description,
            'modal_id' => "archive-picture-modal",
            'url' => route('pictures.destroy', compact('picture'))
        ])
    @endif
@endsection

@include('partials.croup.croup-scripts')