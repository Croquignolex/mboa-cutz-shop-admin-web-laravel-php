@extends('layouts.app')

@section('app.master.title', page_title('Services archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Services archivés ({$services->total()})",
        'icon' => 'mdi mdi-shopping',
        'chain' => ['Services', 'Services archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $services->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">NOM (fr)</th>
                                    <th scope="col">NOM (EN)</th>
                                    <th scope="col">PRIX (FCFA)</th>
                                    <th scope="col">CREER PAR</th>
                                    <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->creation_date }}</td>
                                        <td class="text-center">
                                            <img class="w-45" src="{{ $service->image_src }}" alt="..." />
                                        </td>
                                        <td>{{ $service->fr_name }}</td>
                                        <td>{{ $service->en_name }}</td>
                                        <td class="text-right">{{ format_price($service->price) }}</td>
                                        <td>{{ $service->creator_name}}</td>
                                        <td class="text-center">
                                            @if($service->can_delete)
                                                <button class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$service->slug-restore-service-modal" }}"
                                                        title="Restorer"
                                                >
                                                    <i class="mdi mdi-backup-restore"></i>
                                                    Restorer
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @include('partials.restore-confirmation', [
                                        'name' => $service->fr_name,
                                        'modal_id' => "$service->slug-restore-service-modal",
                                        'url' => route('archives.services.restore', compact('service'))
                                    ])
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $services->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection