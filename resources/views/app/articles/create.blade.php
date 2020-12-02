@extends('layouts.app')

@section('app.master.title', page_title('Nouvel article'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Nouvel article',
        'icon' => 'mdi mdi-blinds',
        'chain' => ['Article', 'Nouvel article']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.toast-message')</div>
                    <form action="{{ route('articles.store') }}" method="POST">
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                @include('partials.form.toggle', [
                                    'name' => 'En vedette',
                                    'id' => 'featured',
                                    'color' => 'info',
                                    'value' => old('featured')
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

@push('app.master.style')
    @if(config('app.env') === 'production')
        <link href="//cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    @else
        <link rel="stylesheet" href="{{ css_asset('quill.snow') }}" type="text/css">
    @endif
@endpush

@push('app.master.script')
    @if(config('app.env') === 'production')
        <script src="//cdn.quilljs.com/1.3.7/quill.min.js"></script>
    @else
        <script src="{{ js_asset('quill.min') }}" type="application/javascript"></script>
    @endif
    <script type="application/javascript">

    </script>
@endpush
