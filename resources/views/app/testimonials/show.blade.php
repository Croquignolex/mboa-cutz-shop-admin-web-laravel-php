@extends('layouts.app')

@section('app.master.title', page_title('Détails témoignage'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Détails témoignage',
        'icon' => 'mdi mdi-face',
        'chain' => ['Témoignages', 'Détails témoignage']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Info--}}
        <div class="col-lg-6 col-xl-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-warning" href="{{ route('testimonials.edit', compact('testimonial')) }}">
                            <i class="mdi mdi-pencil"></i>
                            Modifier
                        </a>
                        <button class="btn btn-danger"
                                data-toggle="modal"
                                data-target="{{ "#archive-testimonial-modal" }}"
                        >
                            <i class="mdi mdi-archive"></i>
                            Archiver
                        </button>
                    </div>
                    <div class="contact-info">
                        <p class="text-dark font-weight-medium pt-4 mb-2">Nom</p>
                        <p>{{ $testimonial->name }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (francais)</p>
                        <p>{{ $testimonial->fr_description }}</p>

                        <p class="text-dark font-weight-medium pt-4 mb-2">Description (anglais)</p>
                        <p>{{ $testimonial->en_description }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{--Logs--}}
        <div class="col-lg-6 col-xl-6">
            <div class="card card-default">
                <div class="card-body">
                    @include('partials.model-image-edit', [
                        'model' => $testimonial,
                        'url' => route('testimonials.update.image', compact('testimonial'))
                    ])
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @include('partials.archive-confirmation', [
        'name' => $testimonial->name,
        'modal_id' => "archive-testimonial-modal",
        'url' => route('testimonials.destroy', compact('testimonial'))
    ])
@endsection

@push('app.master.style')
    <link rel="stylesheet" href="{{ css_asset('cropper.min') }}" type="text/css">
@endpush

@push('app.master.script')
    <script src="{{ js_asset('cropper.min') }}" type="application/javascript"></script>
    <script src="{{ js_asset('image-crouping') }}" type="application/javascript"></script>
@endpush
