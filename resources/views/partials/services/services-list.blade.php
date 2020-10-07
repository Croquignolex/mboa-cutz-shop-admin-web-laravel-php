<div class="mb-3">{{ $services->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">DATE</th>
            <th scope="col">IMAGE</th>
            <th scope="col">NOM (fr)</th>
            <th scope="col">NOM (en)</th>
            <th scope="col">PRIX (FCFA)</th>
            @if($actions)<th scope="col">NOTE</th>@endif
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
                @if($actions)<td class="text-center" style="white-space: nowrap;">@include('partials.rating-star', ['rate' => $service->rate])</td>@endif
                <td>{{ $service->creator_name}}</td>
                <td class="text-center" style="white-space: nowrap;">
                    <a href="{{ route('services.show', compact('service')) }}"
                       class="btn btn-sm btn-primary"
                       title="Détails"
                    >
                        <i class="mdi mdi-eye"></i>
                    </a>
                    <a href="{{ route('services.edit', compact('service')) }}"
                       class="btn btn-sm btn-warning"
                       title="Modifier"
                    >
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    @if($service->can_delete && $actions)
                        <button class="btn btn-sm btn-danger"
                                data-toggle="modal"
                                data-target="{{ "#$service->slug-archive-service-modal" }}"
                                title="Archiver"
                        >
                            <i class="mdi mdi-archive"></i>
                        </button>
                    @endif
                </td>
            </tr>

            @if($service->can_delete && $actions)
                @include('partials.archive.archive-confirmation', [
                    'name' => $service->fr_name,
                    'modal_id' => "$service->slug-archive-service-modal",
                    'url' => route('services.destroy', compact('service'))
                ])
            @endif
        @endforeach
        </tbody>
    </table>
</div>

<div>{{ $services->links() }}</div>