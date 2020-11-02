@if($product->is_a_new)
    <span class="badge badge-pill badge-success mt-1">Nouveau</span>
@endif

@if($product->is_featured)
    <span class="badge badge-pill badge-info mt-1">En vedette</span>
@endif

@if($product->is_a_discount)
    <span class="badge badge-pill badge-secondary mt-1">En promo</span>
@endif

@if($product->is_most_sold)
    <span class="badge badge-pill badge-primary mt-1">Meilleur vente</span>
@endif