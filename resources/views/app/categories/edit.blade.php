@extends('layouts.app')

@section('app.master.title', page_title('Modifier categorie'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Modifier categorie',
        'icon' => 'mdi mdi-database',
        'chain' => ['Categories', 'Modifier categorie']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.error-message')</div>
                    <form action="{{ route('categories.update', compact('category')) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (français)*',
                                    'id' => 'fr_name',
                                    'type' => 'text',
                                    'value' => old('fr_name') ?? $category->fr_name
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (anglais)*',
                                    'id' => 'en_name',
                                    'type' => 'text',
                                    'value' => old('en_name') ?? $category->fr_name
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (français)',
                                    'id' => 'fr_description',
                                    'value' => old('fr_description') ?? $category->fr_description
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                   'name' => 'Description (anglais)',
                                   'id' => 'en_description',
                                   'value' => old('en_description') ?? $category->en_description
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
