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
                    <div class="mx-5">@include('partials.error-message')</div>
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                @include('partials.form.input', [
                                    'name' => 'Nom*',
                                    'id' => 'name',
                                    'type' => 'text',
                                    'value' => old('name')
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
