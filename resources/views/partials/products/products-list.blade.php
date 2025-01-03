<div class="mb-3">{{ $products->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                                    <th scope="col">CREATION</th>
                <th scope="col">IMAGE</th>
                <th scope="col">NOM (fr)</th>
                <th scope="col">NOM (EN)</th>
                <th scope="col">PRIX (FCFA)</th>
                <th scope="col">STOCK</th>
                @if($actions)
                    <th scope="col">NOTE</th>
                    <th scope="col">STATUT</th>
                @endif
                <th scope="col">CREER PAR</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                                        <td style="white-space: nowrap;">{{ $product->creation_date }}</td>
                    <td class="text-center">
                        <img class="w-45" src="{{ $product->image_src }}" alt="..." />
                    </td>
                    <td>{{ $product->fr_name }}</td>
                    <td>{{ $product->en_name }}</td>
                    <td class="text-right">{{ format_price($product->price) }}</td>
                    <td class="text-right">{{ $product->stock }}</td>
                    @if($actions)
                        <td class="text-center" style="white-space: nowrap;">@include('partials.rating-star', ['rate' => $product->rate])</td>
                        <td class="text-center"><small>@include('partials.products.products-status')</small></td>
                    @endif
                    <td>{{ $product->creator_name}}</td>
                    <td class="text-center" style="white-space: nowrap;">
                        <a href="{{ route('products.show', compact('product')) }}"
                           class="btn btn-sm btn-primary"
                           title="Détails"
                        >
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', compact('product')) }}"
                           class="btn btn-sm btn-warning"
                           title="Modifier"
                        >
                            <i class="mdi mdi-pencil"></i>
                        </a>
                        @if($product->can_delete && $actions)
                            <button class="btn btn-sm btn-danger"
                                    data-toggle="modal"
                                    data-target="{{ "#$product->slug-archive-product-modal" }}"
                                    title="Archiver"
                            >
                                <i class="mdi mdi-archive"></i>
                            </button>
                        @endif
                    </td>
                </tr>

                @if($product->can_delete && $actions)
                    @include('partials.archive.archive-confirmation', [
                        'name' => $product->fr_name,
                        'modal_id' => "$product->slug-archive-product-modal",
                        'url' => route('products.destroy', compact('product'))
                    ])
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<div>{{ $products->links() }}</div>