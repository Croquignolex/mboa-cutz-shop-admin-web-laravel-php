@extends('layouts.app')

@section('app.master.title', page_title("Modifier étiquette"))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Modifier étiquette',
        'icon' => 'mdi mdi-tag-multiple',
        'chain' => ['Etiquettes', 'Modifier étiquette']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.toast-message')</div>
                    <form action="{{ route('tags.update', compact('tag')) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (français)*',
                                    'id' => 'fr_name',
                                    'type' => 'text',
                                    'value' => old('fr_name') ?? $tag->fr_name
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom (anglais)*',
                                    'id' => 'en_name',
                                    'type' => 'text',
                                    'value' => old('en_name') ?? $tag->en_name
                                ])
                            </div>
                        </div>
                        {{-- **************************************************** --}}
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                    'name' => 'Description',
                                    'id' => 'description',
                                    'value' => old('description') ?? $tag->description
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
