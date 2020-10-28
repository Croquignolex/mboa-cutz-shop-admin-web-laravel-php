@extends('layouts.app')

@section('app.master.title', page_title('Nouveau client'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Nouveau client',
        'icon' => 'mdi mdi-account-group',
        'chain' => ['Clients', 'Nouveau client']
    ])
@endsection

@section('app.master.body')
    <div class="row no-gutters">
        <div class="col">
            <div class="card card-default">
                <div class="card-body">
                    <div class="mx-5">@include('partials.toast-message')</div>
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Prénom*',
                                    'id' => 'first_name',
                                    'type' => 'text',
                                    'value' => old('first_name'),
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Nom*',
                                    'id' => 'last_name',
                                    'type' => 'text',
                                    'value' => old('last_name'),
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Profession',
                                    'id' => 'profession',
                                    'type' => 'text',
                                    'value' =>  old('profession'),
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                   'name' => 'Email*',
                                   'id' => 'email',
                                   'type' => 'email',
                                   'value' => old('email'),
                               ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                   'name' => 'Téléphone',
                                   'id' => 'phone',
                                   'type' => 'text',
                                   'value' =>  old('phone'),
                               ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                   'name' => 'Adresse',
                                   'id' => 'address',
                                   'type' => 'text',
                                   'value' =>  old('address'),
                               ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Code postal',
                                    'id' => 'post_code',
                                    'type' => 'text',
                                    'value' =>  old('post_code'),
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Ville',
                                    'id' => 'city',
                                    'type' => 'text',
                                    'value' =>  old('city'),
                                ])
                            </div>
                            <div class="col-sm-4">
                                @include('partials.form.input', [
                                    'name' => 'Pays',
                                    'id' => 'country',
                                    'type' => 'text',
                                    'value' =>  old('country'),
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('partials.form.textarea', [
                                   'name' => 'Description',
                                   'id' => 'description',
                                   'value' => old('description'),
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
