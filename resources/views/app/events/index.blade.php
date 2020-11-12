@extends('layouts.app')

@section('app.master.title', page_title('Evènements'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Evènements ({$events->total()})",
        'icon' => 'mdi mdi-string-lights',
        'chain' => ['Evènements']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('events.create') }}">
                            <i class="mdi mdi-plus"></i>
                            Nouvel évènement
                        </a>
                    </div>

                    <div class="mb-3">{{ $events->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                    <th scope="col">CREATION</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">NOM (FR)</th>
                                <th scope="col">NOM (EN)</th>
                                <th scope="col">DEBUT</th>
                                <th scope="col">FIN</th>
                                <th scope="col">CREER PAR</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $event->creation_date }}</td>
                                        <td class="text-center">
                                            <img class="rounded-circle w-45" src="{{ $event->image_src }}" alt="..." />
                                        </td>
                                        <td>{{ $event->fr_name }}</td>
                                        <td>{{ $event->en_name }}</td>
                                        <td>{{ $event->start_date }}</td>
                                        <td>{{ $event->end_date }}</td>
                                        <td>{{ $event->creator_name}}</td>
                                        <td class="text-center" style="white-space: nowrap;">
                                            <a href="{{ route('events.show', compact('event')) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Détails"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('events.edit', compact('event')) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Modifier"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @if($event->can_delete)
                                                <button class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$event->id-archive-event-modal" }}"
                                                        title="Archiver"
                                                >
                                                    <i class="mdi mdi-archive"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($event->can_delete)
                                        @include('partials.archive.archive-confirmation', [
                                            'name' => $event->fr_name,
                                            'modal_id' => "$event->id-archive-event-modal",
                                            'url' => route('events.destroy', compact('event'))
                                        ])
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $events->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection