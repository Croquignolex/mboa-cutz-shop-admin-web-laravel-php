<div class="mb-3">{{ $reviews->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">DATE</th>
                <th scope="col">COMMENTAIRE</th>
                <th scope="col">NOTE</th>
                <th scope="col">CREER PAR</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->creation_date }}</td>
                    <td>{{ $review->description }}</td>
                    <td class="text-center" style="white-space: nowrap;">@include('partials.rating-star', ['rate' => $review->rate])</td>
                    <td>{{ $review->creator_name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>{{ $reviews->links() }}</div>