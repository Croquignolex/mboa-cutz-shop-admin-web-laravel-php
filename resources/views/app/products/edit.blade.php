@extends('layouts.app')

@section('app.master.title', page_title('Modifier produit'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Modifier produit',
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits', 'Modifier produit']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.toast-message')</div>
                    <form action="{{ route('products.update', compact('product')) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="col">
                                @include('partials.form.toggle', [
                                    'name' => 'En vedette',
                                    'id' => 'featured',
                                    'color' => 'info',
                                    'value' => old('featured') ?? $product->is_featured
                                ])
                                @include('partials.form.toggle', [
                                    'name' => 'Nouveau',
                                    'id' => 'new',
                                    'color' => 'success',
                                    'value' => old('new') ?? $product->is_a_new
                                ])
                                @include('partials.form.toggle', [
                                    'name' => 'Mailleur vente',
                                    'id' => 'most_sold',
                                    'color' => 'primary',
                                    'value' => old('most_sold') ?? $product->is_most_sold
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (français)*',
                                    'id' => 'fr_name',
                                    'type' => 'text',
                                    'value' => old('fr_name') ?? $product->fr_name
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (anglais)*',
                                    'id' => 'en_name',
                                    'type' => 'text',
                                    'value' => old('en_name') ?? $product->en_name
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Prix*',
                                    'id' => 'price',
                                    'type' => 'number',
                                    'value' => old('price') ?? $product->price
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Reduction (%)*',
                                    'id' => 'discount',
                                    'type' => 'number',
                                    'value' => old('discount') ?? $product->discount
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Stock*',
                                    'id' => 'stock',
                                    'type' => 'number',
                                    'value' => old('stock') ?? $product->stock
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.select', [
                                    'name' => 'Catégorie*',
                                    'id' => 'category',
                                    'title' => 'Choisir une catégorie',
                                    'value' => old('category') ?? $product->category->slug,
                                    'options' => $categories,
                                    'multi' => false
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.select', [
                                    'name' => 'Etiquettes',
                                    'id' => 'tags',
                                    'title' => 'Choisir des étiquettes',
                                    'value' => old('tags') ?? $selectedTags,
                                    'options' => $tags,
                                    'multi' => true
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (français)',
                                    'id' => 'fr_description',
                                    'value' => old('fr_description') ?? $product->fr_description
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (anglais)',
                                    'id' => 'en_description',
                                    'value' => old('en_description') ?? $product->en_description
                                ])
                            </div>
                        </div>
                        @include('partials.form.submit')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('partials.select-scripts')