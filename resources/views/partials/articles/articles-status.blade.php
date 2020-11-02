@if($article->is_a_new)
    <span class="badge badge-pill badge-success mt-1">Nouveau</span>
@endif

@if($article->is_featured)
    <span class="badge badge-pill badge-info mt-1">En vedette</span>
@endif