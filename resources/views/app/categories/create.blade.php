@extends('layouts.app')

@section('app.master.title', page_title('Nouvelle categorie'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Nouvelle categorie',
        'icon' => 'mdi mdi-database',
        'chain' => ['Categories', 'Nouvelle categorie']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Ajouter une nouvelle categorie</h2>
                </div>
                <div class="card-body">
                    <div class="mx-5">@include('partials.error-message')</div>
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
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
