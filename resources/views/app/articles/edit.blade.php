@extends('layouts.app')

@section('app.master.title', page_title('Modifier article'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Modifier article',
        'icon' => 'mdi mdi-blinds',
        'chain' => ['Articles', 'Modifier article']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.error-message')</div>
                    <form action="{{ route('articles.update', compact('article')) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="col">
                                @include('partials.form.toggle', [
                                    'name' => 'En vedette',
                                    'id' => 'featured',
                                    'color' => 'info',
                                    'value' => old('featured') ?? $article->is_featured
                                ])
                                @include('partials.form.toggle', [
                                    'name' => 'Nouveau',
                                    'id' => 'new',
                                    'color' => 'success',
                                    'value' => old('new') ?? $article->is_a_new
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (français)*',
                                    'id' => 'fr_name',
                                    'type' => 'text',
                                    'value' => old('fr_name') ?? $article->fr_name
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (anglais)*',
                                    'id' => 'en_name',
                                    'type' => 'text',
                                    'value' => old('en_name') ?? $article->en_name
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.select', [
                                    'name' => 'Catégorie*',
                                    'id' => 'category',
                                    'title' => 'Choisir une catégorie',
                                    'value' => old('category') ?? $article->category->slug,
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
                                    'value' => old('fr_description') ?? $article->fr_description
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description (anglais)',
                                    'id' => 'en_description',
                                    'value' => old('en_description') ?? $article->en_description
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