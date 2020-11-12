@extends('layouts.app')

@section('app.master.title', page_title('Nouveau service'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Nouveau service',
        'icon' => 'mdi mdi-shopping',
        'chain' => ['Services', 'Nouveau service']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.toast-message')</div>
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                @include('partials.form.toggle', [
                                    'name' => 'En vedette',
                                    'id' => 'featured',
                                    'color' => 'info',
                                    'value' => old('featured')
                                ])
                                @include('partials.form.toggle', [
                                    'name' => 'Mailleur réservation',
                                    'id' => 'most_asked',
                                    'color' => 'primary',
                                    'value' => old('most_asked')
                                ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (français)*',
                                    'id' => 'fr_name',
                                    'type' => 'text',
                                    'value' => old('fr_name')
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (anglais)*',
                                    'id' => 'en_name',
                                    'type' => 'text',
                                    'value' => old('en_name')
                                ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Prix*',
                                    'id' => 'price',
                                    'type' => 'number',
                                    'value' => old('price') ?? 0
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Reduction (%)*',
                                    'id' => 'discount',
                                    'type' => 'number',
                                    'value' => old('discount') ?? 0
                                ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.select', [
                                    'name' => 'Catégorie*',
                                    'id' => 'category',
                                    'title' => 'Choisir une catégorie',
                                    'value' => old('category'),
                                    'options' => $categories,
                                    'multi' => false
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.select', [
                                    'name' => 'Etiquettes',
                                    'id' => 'tags',
                                    'title' => 'Choisir des étiquettes',
                                    'value' => old('tags') ?? [],
                                    'options' => $tags,
                                    'multi' => true
                                ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (français)',
                                    'id' => 'fr_description',
                                    'value' => old('fr_description')
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (anglais)',
                                    'id' => 'en_description',
                                    'value' => old('en_description')
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