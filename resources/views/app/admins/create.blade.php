@extends('layouts.app')

@section('app.master.title', page_title('Nouvel administrateur'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Nouvel administrateur',
        'icon' => 'mdi mdi-account-multiple',
        'chain' => ['Administrateurs', 'Nouvel administrateur']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Ajouter un nouvel administrateur</h2>
                </div>
                <div class="card-body">
                    <div class="mx-5">@include('partials.error-message')</div>
                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.select', [
                                    'name' => 'Role*',
                                    'id' => 'role',
                                    'title' => 'Choisir un role',
                                    'value' => old('role'),
                                    'options' => $roles
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Prénom*',
                                    'id' => 'first_name',
                                    'type' => 'text',
                                    'value' => old('first_name'),
                                ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Nom*',
                                    'id' => 'last_name',
                                    'type' => 'text',
                                    'value' => old('last_name'),
                                ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Profession',
                                    'id' => 'profession',
                                    'type' => 'text',
                                    'value' =>  old('profession'),
                                ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                   'name' => 'Email*',
                                   'id' => 'email',
                                   'type' => 'email',
                                   'value' => old('email'),
                               ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                   'name' => 'Téléphone',
                                   'id' => 'phone',
                                   'type' => 'text',
                                   'value' =>  old('phone'),
                               ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                   'name' => 'Adresse',
                                   'id' => 'address',
                                   'type' => 'text',
                                   'value' =>  old('address'),
                               ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Code postal',
                                    'id' => 'post_code',
                                    'type' => 'text',
                                    'value' =>  old('post_code'),
                                ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Ville',
                                    'id' => 'city',
                                    'type' => 'text',
                                    'value' =>  old('city'),
                                ])
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                @include('partials.form.input', [
                                    'name' => 'Pays',
                                    'id' => 'country',
                                    'type' => 'text',
                                    'value' =>  old('country'),
                                ])
                            </div>
                            <div class="col-sm-8 col-xs-12">
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

