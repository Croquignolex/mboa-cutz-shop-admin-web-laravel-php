<div class="mb-3">{{ $reviews->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">DATE</th>
                <th scope="col">COMMENTAIRE</th>
                <th scope="col">NOTE</th>
                <th scope="col">CREER PAR</th>
                @if($review->can_delete)<th scope="col">ACTION</th>@endif
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->creation_date }}</td>
                    <td>{{ $review->description }}</td>
                    <td class="text-center" style="white-space: nowrap;">@include('partials.rating-star', ['rate' => $review->rate])</td>
                    <td>{{ $review->creator_name}}</td>
                    @if($review->can_delete)
                        <td>
                            <button class="btn btn-sm btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#$review->id-archive-review-modal" }}"
                                    title="Archiver"
                            >
                                <i class="mdi mdi-archive"></i>
                            </button>
                        </td>
                    @endif
                </tr>
                @if($review->can_delete)
                    @include('partials.archive.archive-confirmation', [
                        'name' => $review->creator_name,
                        'modal_id' => "$review->id-archive-review-modal",
                        'url' => route('products.remove.review', compact('product', ''))
                    ])
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<div>{{ $reviews->links() }}</div>