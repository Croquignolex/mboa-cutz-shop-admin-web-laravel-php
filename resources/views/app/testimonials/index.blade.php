@extends('layouts.app')

@section('app.master.title', page_title('Témoignages'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Témoignages ({$testimonials->total()})",
        'icon' => 'mdi mdi-face',
        'chain' => ['Témoignages']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('testimonials.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouveau témoignage
                        </a>
                    </div>

                    <div class="mb-3">{{ $testimonials->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">NOM</th>
                                <th scope="col">DESCRIPTION (FR)</th>
                                <th scope="col">DESCRIPTION (en)</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $testimonial->creation_date }}</td>
                                        <td class="text-center">
                                            <img class="rounded-circle w-45" src="{{ $testimonial->image_src }}" alt="..." />
                                        </td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>{{ $testimonial->fr_description }}</td>
                                        <td>{{ $testimonial->en_description }}</td>
                                        <td>{{ $testimonial->creator_name}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('testimonials.show', compact('testimonial')) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Détails"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('testimonials.edit', compact('testimonial')) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Modifier"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger"
                                                    data-toggle="modal"
                                                    data-target="{{ "#$testimonial->slug-archive-testimonial-modal" }}"
                                                    title="Archiver"
                                            >
                                                <i class="mdi mdi-archive"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @include('partials.archive.archive-confirmation', [
                                        'name' => $testimonial->fr_name,
                                        'modal_id' => "$testimonial->slug-archive-testimonial-modal",
                                        'url' => route('testimonials.destroy', compact('testimonial'))
                                    ])
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $testimonials->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection