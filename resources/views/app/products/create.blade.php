@extends('layouts.app')

@section('app.master.title', page_title('Nouveau produit'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Nouveau produit',
        'icon' => 'mdi mdi-basket',
        'chain' => ['Produits', 'Nouveau produit']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Nouvel intervenant</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                @include('partials.form.select', [
                                    'name' => 'Nom (français)',
                                    'id' => 'fr_name',
                                    'icon' => 'mdi mdi-format-align-top',
                                    'value' => old('fr_name')
                                ])
                            </div>
                            <div class="col-sm-6 col-xs-12">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Nom (français)',
                                    'id' => 'fr_name',
                                    'icon' => 'mdi mdi-format-align-top',
                                    'type' => 'text',
                                    'value' => old('fr_name')
                                ])
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Nom (anglais)',
                                    'id' => 'en_name',
                                    'icon' => 'mdi mdi-format-align-top',
                                    'type' => 'text',
                                    'value' => old('en_name')
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                   'name' => 'Prix',
                                   'id' => 'price',
                                   'icon' => 'mdi mdi-cash-multiple',
                                   'type' => 'number',
                                   'value' => old('price')
                               ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Réduction',
                                    'id' => 'discount',
                                    'icon' => 'mdi mdi-percent',
                                    'type' => 'number',
                                    'value' => old('discount')
                                ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Stock',
                                    'id' => 'stock',
                                    'icon' => 'mdi mdi-buffer',
                                    'type' => 'number',
                                    'value' => old('stock')
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (français)',
                                    'id' => 'fr_description',
                                    'icon' => 'mdi mdi-format-align-justify',
                                    'value' => old('fr_description')
                                ])
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                @include('partials.form.textarea', [
                                   'name' => 'Description (anglais)',
                                   'id' => 'en_description',
                                   'icon' => 'mdi mdi-format-align-justify',
                                   'value' => old('en_description')
                               ])
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('app.master.style')
    <link rel="stylesheet" href="{{ css_asset('bootstrap-select.min') }}" type="text/css">
@endpush

@push('app.master.script')
    <script src="{{ js_asset('bootstrap-select.min') }}" type="application/javascript"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('.searchable-select').selectpicker();
        });
    </script>
@endpush

