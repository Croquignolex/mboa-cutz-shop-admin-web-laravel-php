@extends('layouts.app')

@section('app.master.title', page_title('Commentaires de service archivés'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => "Commentaires de service archivés ({$reviews->total()})",
        'icon' => 'mdi mdi-comment-text-outline',
        'chain' => ['Archives', 'Commentaires de service archivés']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">

                    <div class="mb-3">{{ $reviews->links() }}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">CREATION</th>
                                    <th scope="col">COMMENTAIRE</th>
                                    <th scope="col">NOTE</th>
                                    <th scope="col">SERVICE</th>
                                    <th scope="col">CREER PAR</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $review->creation_date }}</td>
                                        <td>{{ $review->description }}</td>
                                        <td class="text-center" style="white-space: nowrap;">@include('partials.rating-star', ['rate' => $review->rate])</td>
                                        <td>
                                            <a href="{{ route('services.show', ['service' => $review->service]) }}"
                                               class="btn btn-sm btn-outline-primary"
                                            >
                                                {{ $review->service->fr_name}}
                                            </a>
                                        </td>
                                        <td>{{ $review->creator_name}}</td>
                                        <td class="text-center">
                                            @if($review->can_delete)
                                                <button class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="{{ "#$review->id-restore-review-modal" }}"
                                                        title="Restorer"
                                                >
                                                    <i class="mdi mdi-backup-restore"></i>
                                                    Restorer
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($review->can_delete)
                                        @include('partials.restore-confirmation', [
                                            'name' => $review->creation_date,
                                            'modal_id' => "$review->id-restore-review-modal",
                                            'url' => route('archives.service-reviews.restore', compact('review'))
                                        ])
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>{{ $reviews->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection