<div class="mb-3">{{ $products->links() }}</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">DATE</th>
            <th scope="col">IMAGE</th>
            <th scope="col">NOM (fr)</th>
            <th scope="col">NOM (en)</th>
            <th scope="col">PRIX (FCFA)</th>
            <th scope="col">STOCK</th>
            <th scope="col">CREER PAR</th>
            <th scope="col">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->creation_date }}</td>
                <td class="text-center">
                    <img class="w-45" src="{{ $product->image_src }}" alt="..." />
                </td>
                <td>{{ $product->fr_name }}</td>
                <td>{{ $product->en_name }}</td>
                <td class="text-right">{{ format_price($product->price) }}</td>
                <td class="text-right">{{ $product->stock }}</td>
                <td>{{ $product->creator_name}}</td>
                <td class="text-center">
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