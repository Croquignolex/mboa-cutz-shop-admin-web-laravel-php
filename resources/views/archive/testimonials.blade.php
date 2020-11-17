@extends('layouts.app')

@section('app.master.title', page_title('Témoignages archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Témoignages archivés ({$testimonials->total()})",
        'icon' => 'mdi mdi-face',
        'chain' => ['Archives', 'Témoignages archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $testimonials->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                    <th scope="col">CREATION</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">NOM</th>
                                <th scope="col">DESCRIPTION (fr)</th>
                                <th scope="col">DESCRIPTION (EN)</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                        <td style="white-space: nowrap;">{{ $testimonial->creation_date }}</td>
                                    <td class="text-center">
                                        <img class="rounded-circle w-45" src="{{ $testimonial->image_src }}" alt="..." />
                                    </td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->fr_description }}</td>
                                    <td>{{ $testimonial->en_description}}</td>
                                    <td>{{ $testimonial->creator_name}}</td>
                                    <td class="text-center">
                                        @if($testimonial->can_delete)
                                            <button class="btn btn-sm btn-success"
                                                    data-toggle="modal"
                                                    data-target="{{ "#$testimonial->id-restore-testimonial-modal" }}"
                                                    title="Restorer"
                                            >
                                                <i class="mdi mdi-backup-restore"></i>
                                                Restorer
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                @if($testimonial->can_delete)
                                    @include('partials.restore-confirmation', [
                                        'name' => $testimonial->name,
                                        'modal_id' => "$testimonial->id-restore-testimonial-modal",
                                        'url' => route('archives.testimonials.restore', compact('testimonial'))
                                    ])
                                @endif
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